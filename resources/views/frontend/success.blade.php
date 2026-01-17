@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 text-center">
    <div class="mb-8">
        <i class="ri-checkbox-circle-fill text-6xl text-green-500"></i>
    </div>
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Pembayaran Berhasil!</h1>
    <p class="text-gray-600 text-lg mb-8">Terima kasih telah berbelanja di LUMINA Beauty. Pesanan Anda akan segera kami proses.</p>
    
    <a href="{{ route('home') }}" class="inline-block bg-gray-800 text-white px-8 py-3 rounded-button font-bold hover:bg-gray-700 transition-colors">
        Kembali Belanja
    </a>
</div>
@endsection