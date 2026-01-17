@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 font-pacifico">{{ $title }}</h1>
        <p class="text-gray-600">Temukan rangkaian perawatan terbaik untuk kulit Anda</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            @include('frontend.partials.product-card', ['product' => $product])
        @empty
            <div class="col-span-4 text-center py-20">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <i class="ri-inbox-line text-4xl text-gray-400"></i>
                </div>
                <p class="text-gray-500">Belum ada produk di series ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('home') }}" class="text-primary font-bold hover:underline">Kembali ke Beranda</a>
    </div>
</div>
@endsection