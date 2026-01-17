<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Midtrans\Config; // Tambahkan ini
use Midtrans\Snap;   // Tambahkan ini

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Keranjang kosong!');
        }
        return view('frontend.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required|email',
            'address' => 'required',
        ]);

        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        try {
            DB::beginTransaction();

            // 1. Simpan Order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'address' => $request->address,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // 2. Simpan Item
            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            // 3. KONFIGURASI MIDTRANS
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // 4. SIAPKAN PARAMETER MIDTRANS
            $midtrans_params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'email' => $order->customer_email,
                    'phone' => $order->customer_phone,
                ],
                // Opsional: Item details bisa dimasukkan juga agar muncul di email midtrans
            ];

            // 5. DAPATKAN SNAP TOKEN
            $snapToken = Snap::getSnapToken($midtrans_params);

            // 6. SIMPAN TOKEN KE ORDER
            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            // 7. HAPUS KERANJANG & REDIRECT KE HALAMAN BAYAR
            session()->forget('cart');
            return redirect()->route('payment.show', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Fungsi Baru: Menampilkan Halaman Bayar
    public function showPayment($id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.payment', compact('order'));
    }
    
    // Fungsi Baru: Sukses Bayar (Redirect dari JS nanti)
    public function success($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid'; // Seharusnya ini via Webhook, tapi untuk simulasi kita update manual disini
        $order->save();
        return view('frontend.success', compact('order'));
    }
}