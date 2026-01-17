<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // Ambil order berdasarkan email user yang login
        $orders = Order::where('customer_email', Auth::user()->email)
                        ->latest()
                        ->get();
        return view('frontend.orders.index', compact('orders'));
    }
}