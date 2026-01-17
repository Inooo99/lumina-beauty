@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <a href="{{ route('home') }}#tips" class="inline-flex items-center text-gray-500 hover:text-primary mb-8 font-medium transition-colors">
        <i class="ri-arrow-left-line mr-2"></i> Kembali ke Tips
    </a>

    <article class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6 leading-tight">
            {{ $article['title'] }}
        </h1>
        
        <div class="flex items-center gap-6 text-sm text-gray-500 mb-8 border-b border-gray-100 pb-8">
            <span class="flex items-center gap-2"><i class="ri-calendar-line"></i> {{ $article['date'] }}</span>
            <span class="flex items-center gap-2"><i class="ri-user-line"></i> Ditulis oleh Tim Lumina</span>
        </div>

        <div class="aspect-video rounded-xl overflow-hidden mb-10 bg-gray-100">
            <img src="{{ $article['image'] }}" class="w-full h-full object-cover" alt="{{ $article['title'] }}">
        </div>

        <div class="prose prose-lg text-gray-600 leading-relaxed max-w-none">
            {!! $article['content'] !!}
        </div>
        
        <div class="mt-12 p-6 bg-secondary/30 rounded-xl flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h4 class="font-bold text-gray-800">Tertarik mencoba produk kami?</h4>
                <p class="text-sm text-gray-600">Temukan rangkaian perawatan terbaik sesuai tips di atas.</p>
            </div>
            <a href="{{ route('home') }}#series" class="bg-primary text-gray-800 px-6 py-2 rounded-button font-bold text-sm hover:bg-opacity-90 whitespace-nowrap">
                Lihat Produk
            </a>
        </div>
    </article>
</div>
@endsection