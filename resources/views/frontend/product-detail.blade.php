@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
<nav class="text-sm text-gray-500 mb-8 flex items-center">
    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
    
    <span class="mx-2 text-gray-300">/</span>
    
    <a href="{{ route('home') }}#{{ $product->category }}" class="capitalize hover:text-primary transition-colors">
        {{ str_replace('_', ' ', $product->category) }}
    </a>
    
    <span class="mx-2 text-gray-300">/</span>
    
    <span class="text-gray-800 font-medium truncate">{{ $product->name }}</span>
</nav>

    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-sm aspect-square relative">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            
            @if($product->is_featured)
            <div class="absolute top-4 left-4 bg-primary text-gray-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                Unggulan
            </div>
            @endif
        </div>

        <div class="flex flex-col justify-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 font-pacifico">{{ $product->name }}</h1>
            
            <div class="text-2xl font-bold text-primary mb-6">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                <p>{{ $product->description }}</p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex gap-4">
                @csrf
                <button type="submit" class="flex-1 bg-gray-800 text-white py-4 rounded-button font-bold text-lg hover:bg-gray-700 transition-colors shadow-lg flex items-center justify-center gap-2">
                    <i class="ri-shopping-bag-3-line"></i> Tambah ke Keranjang
                </button>
            </form>

            <div class="mt-8 border-t border-gray-100 pt-6 grid grid-cols-2 gap-4 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <i class="ri-shield-check-line text-green-500 text-lg"></i> 100% Original
                </div>
                <div class="flex items-center gap-2">
                    <i class="ri-truck-line text-blue-500 text-lg"></i> Pengiriman Cepat
                </div>
            </div>
        </div>
    </div>

    @if($related_products->count() > 0)
    <div class="border-t border-gray-100 pt-16">
        <h3 class="text-2xl font-bold text-gray-800 mb-8">Produk Sejenis</h3>
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($related_products as $related)
                @include('frontend.partials.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection