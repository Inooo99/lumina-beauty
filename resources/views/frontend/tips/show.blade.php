@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <a href="{{ route('home') }}#tips" class="inline-flex items-center text-gray-500 hover:text-primary mb-8 transition-colors">
        <i class="ri-arrow-left-line mr-2"></i> Kembali ke Tips
    </a>

    <article class="prose lg:prose-xl mx-auto">
        <div class="aspect-video rounded-2xl overflow-hidden mb-8 bg-gray-100">
            <img src="https://readdy.ai/api/search-image?query=Skincare%20routine%20flatlay&width=800&height=400" class="w-full h-full object-cover">
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-4 capitalize">
            {{ str_replace('-', ' ', $slug) }}
        </h1>

        <div class="flex items-center gap-4 text-sm text-gray-500 mb-8">
            <span><i class="ri-calendar-line"></i> 15 Januari 2026</span>
            <span><i class="ri-user-line"></i> Admin Lumina</span>
        </div>

        <div class="text-gray-600 leading-relaxed space-y-4">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ini adalah contoh halaman artikel detail. Di sini Anda bisa menjelaskan tips kecantikan secara lengkap.</p>
            <p><strong>Langkah 1: Pembersihan</strong><br>Pastikan wajah bersih dari debu dan makeup...</p>
            <p><strong>Langkah 2: Toner</strong><br>Gunakan toner untuk menyeimbangkan pH kulit...</p>
            <p><strong>Langkah 3: Serum</strong><br>Aplikasikan serum sesuai kebutuhan kulit...</p>

            <div class="bg-primary/10 p-6 rounded-xl my-8 border border-primary/20">
                <h4 class="font-bold text-gray-800 mb-2">Tips Pro:</h4>
                <p class="text-sm">Jangan lupa gunakan sunscreen di pagi hari untuk melindungi kulit dari sinar UV!</p>
            </div>

            <p>Semoga tips ini bermanfaat untuk rutinitas harian Anda!</p>
        </div>
    </article>
</div>
@endsection