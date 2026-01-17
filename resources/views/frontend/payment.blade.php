@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center">
        
        <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="ri-check-line text-4xl text-green-500"></i>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pesanan Dibuat!</h1>
        <p class="text-gray-600 mb-8">Kode Order: <span class="font-mono font-bold">{{ $order->order_number }}</span></p>

        <div class="bg-gray-50 p-6 rounded-xl mb-8 text-left max-w-md mx-auto">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Total Tagihan:</span>
                <span class="font-bold text-gray-800 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Penerima:</span>
                <span class="font-medium text-gray-800">{{ $order->customer_name }}</span>
            </div>
        </div>

        <button id="pay-button" class="bg-primary text-gray-800 px-12 py-4 rounded-button font-bold text-lg hover:bg-opacity-90 transition-all shadow-lg transform hover:-translate-y-1">
            Bayar Sekarang
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken didapat dari Controller tadi
        snap.pay('{{ $order->snap_token }}', {
            // Callback jika sukses
            onSuccess: function(result){
                window.location.href = "{{ route('payment.success', $order->id) }}";
            },
            // Callback jika pending
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
                console.log(result);
            },
            // Callback jika error
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },
            // Callback jika ditutup
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection