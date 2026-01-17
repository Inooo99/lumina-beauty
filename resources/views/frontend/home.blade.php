@extends('layouts.app')

@section('content')

<section class="relative h-96 md:h-[500px] overflow-hidden" style="background: linear-gradient(135deg, #F5F3F0 0%, #FDF8F3 100%);">
    <div class="absolute inset-0" style="background-image: url('https://readdy.ai/api/search-image?query=Beautiful%20Asian%20woman%20with%20glowing%20skin%20holding%20skincare%20serum%20bottle%2C%20soft%20natural%20lighting%2C%20minimalist%20cream%20background%2C%20professional%20beauty%20photography%2C%20elegant%20pose%2C%20dewy%20makeup%20look%2C%20natural%20beauty%20concept&width=1200&height=500&seq=hero1&orientation=landscape'); background-size: cover; background-position: center;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-white/80 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="max-w-lg">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">Temukan Kecantikan Alami Anda</h2>
            <p class="text-lg text-gray-600 mb-6">Produk kecantikan premium dengan bahan alami pilihan untuk merawat kulit Indonesia yang cantik</p>
            <a href="#series" class="bg-primary text-gray-800 px-8 py-3 !rounded-button font-semibold hover:bg-opacity-90 transition-colors whitespace-nowrap">Belanja Sekarang</a>
        </div>
    </div>
</section>

<section class="py-16 bg-secondary" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">Produk Unggulan</h3>
            <p class="text-gray-600">Koleksi terbaik untuk perawatan kecantikan harian Anda</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featured_products as $product)
                
                @include('frontend.partials.product-card', ['product' => $product])

            @empty
                <div class="col-span-4 text-center text-gray-500 py-10">
                    <p>Belum ada produk unggulan yang dipilih.</p>
                    <a href="{{ route('login') }}" class="text-primary underline">Login Admin</a> untuk mengatur.
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50" id="series">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">Koleksi Series</h3>
            <p class="text-gray-600">Rangkaian perawatan lengkap untuk hasil optimal</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="aspect-video mb-4 rounded-lg overflow-hidden" style="background-image: url('https://readdy.ai/api/search-image?query=Brightening%20skincare%20series%20products%20set%2C%20vitamin%20C%20collection%2C%20clean%20white%20background%2C%20professional%20product%20photography%2C%20elegant%20packaging%20design%2C%20golden%20accents&width=400&height=250&seq=series1&orientation=landscape'); background-size: cover; background-position: center;"></div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Brightening Series</h4>
                <p class="text-sm text-gray-600 mb-4">Rangkaian pencerah kulit dengan vitamin C untuk wajah glowing alami</p>
                <a href="{{ route('series.show', 'brightening') }}" class="block w-full text-center bg-primary text-gray-800 py-2 !rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap">Lihat Koleksi</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="aspect-video mb-4 rounded-lg overflow-hidden" style="background-image: url('https://readdy.ai/api/search-image?query=Anti-aging%20skincare%20series%20collection%2C%20premium%20anti-wrinkle%20products%2C%20elegant%20gold%20packaging%2C%20clean%20background%2C%20professional%20beauty%20photography%2C%20luxury%20skincare%20set&width=400&height=250&seq=series2&orientation=landscape'); background-size: cover; background-position: center;"></div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Anti-Aging Series</h4>
                <p class="text-sm text-gray-600 mb-4">Perawatan anti-penuaan lengkap untuk kulit kencang dan awet muda</p>
                <a href="{{ route('series.show', 'anti_aging') }}" class="block w-full text-center bg-primary text-gray-800 py-2 !rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap">Lihat Koleksi</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="aspect-video mb-4 rounded-lg overflow-hidden" style="background-image: url('https://readdy.ai/api/search-image?query=Acne%20care%20skincare%20series%20products%2C%20clear%20skin%20treatment%20collection%2C%20clean%20medical%20packaging%2C%20professional%20photography%2C%20minimalist%20design%2C%20dermatology%20approved&width=400&height=250&seq=series3&orientation=landscape'); background-size: cover; background-position: center;"></div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Acne Care Series</h4>
                <p class="text-sm text-gray-600 mb-4">Solusi lengkap perawatan kulit berjerawat untuk wajah bersih bebas noda</p>
                <a href="{{ route('series.show', 'acne_care') }}" class="block w-full text-center bg-primary text-gray-800 py-2 !rounded-button font-medium hover:bg-opacity-90 transition-colors whitespace-nowrap">Lihat Koleksi</a>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gradient-to-r from-secondary to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Filosofi Kecantikan Kami</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    LUMINA Beauty percaya bahwa kecantikan sejati berasal dari dalam. Kami menghadirkan produk-produk berkualitas tinggi dengan bahan alami pilihan yang diformulasikan khusus untuk kulit wanita Indonesia.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Setiap produk LUMINA dibuat dengan standar internasional dan telah teruji dermatologi untuk memberikan hasil terbaik tanpa mengorbankan kesehatan kulit Anda.
                </p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 bg-white rounded-lg">
                        <div class="text-2xl font-bold text-primary mb-1">100%</div>
                        <div class="text-sm text-gray-600">Halal & Natural</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg">
                        <div class="text-2xl font-bold text-primary mb-1">5+</div>
                        <div class="text-sm text-gray-600">Tahun Penelitian</div>
                    </div>
                </div>
            </div>
            <div class="aspect-square rounded-lg overflow-hidden" style="background-image: url('https://readdy.ai/api/search-image?query=Natural%20skincare%20ingredients%20arrangement%2C%20botanical%20extracts%20and%20essential%20oils%2C%20soft%20natural%20lighting%2C%20clean%20minimalist%20composition%2C%20organic%20beauty%20concept%2C%20professional%20photography&width=500&height=500&seq=brand1&orientation=squarish'); background-size: cover; background-position: center;"></div>
        </div>
    </div>
</section>

<section class="py-16" id="tips"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">Tips Kecantikan & Panduan</h3>
            <p class="text-gray-600">Pelajari cara merawat kulit dengan benar dari para ahli</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="h-48" style="background-image: url('https://i.pinimg.com/736x/7b/ac/29/7bac299de8fc55844950597dacf6b85e.jpg'); background-size: cover; background-position: center;"></div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">15 Januari 2026</div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">5 Langkah Skincare Routine</h4>
                    <a href="{{ route('tips.show', 'skincare-routine') }}" class="text-primary font-semibold text-sm hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>
            
            <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="h-48" style="background-image: url('https://readdy.ai/api/search-image?query=Natural%20makeup%20look%20tutorial%2C%20Korean%20glass%20skin%20makeup%2C%20soft%20natural%20lighting%2C%20beauty%20blogger%20applying%20makeup%2C%20professional%20beauty%20photography%2C%20minimalist%20makeup%20concept&width=400&height=200&seq=article2&orientation=landscape'); background-size: cover; background-position: center;"></div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">12 Januari 2026</div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Tutorial Natural Makeup</h4>
                    <a href="{{ route('tips.show', 'natural-makeup') }}" class="text-primary font-semibold text-sm hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>
            
            <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="h-48" style="background-image: url('https://readdy.ai/api/search-image?query=Skincare%20ingredients%20knowledge%2C%20vitamin%20C%20serum%20science%2C%20laboratory%20research%2C%20professional%20educational%20photography%2C%20beauty%20science%20concept%2C%20clean%20modern%20setting&width=400&height=200&seq=article3&orientation=landscape'); background-size: cover; background-position: center;"></div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">10 Januari 2026</div>
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Mengenal Bahan Aktif</h4>
                    <a href="{{ route('tips.show', 'active-ingredients') }}" class="text-primary font-semibold text-sm hover:underline">Baca Selengkapnya →</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="py-16 bg-primary">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-12 h-12 flex items-center justify-center bg-white rounded-lg mx-auto mb-6">
            <i class="ri-mail-line text-gray-800 text-xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Tetap Update dengan LUMINA</h3>
        <p class="text-gray-700 mb-8">Dapatkan tips kecantikan terbaru, promo eksklusif, dan informasi produk baru langsung di inbox Anda</p>
        
        <div class="flex max-w-md mx-auto">
            <div class="relative flex-1">
                <input type="email" placeholder="Masukkan email Anda" class="w-full pl-12 pr-4 py-3 border-none rounded-l-lg focus:outline-none focus:ring-2 focus:ring-gray-800 text-gray-800">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <div class="w-4 h-4 flex items-center justify-center">
                        <i class="ri-mail-line text-gray-400"></i>
                    </div>
                </div>
            </div>
            <button class="bg-gray-800 text-white px-6 py-3 !rounded-button rounded-l-none font-semibold hover:bg-gray-700 transition-colors whitespace-nowrap">Berlangganan</button>
        </div>
    </div>
</section>

@push('scripts')
<script id="hero-slider">
    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.querySelector('section[style*="background: linear-gradient"]');
        if(heroSection) {
            const slides = [
                {
                    image: 'https://readdy.ai/api/search-image?query=Beautiful%20Asian%20woman%20with%20glowing%20skin%20holding%20skincare%20serum%20bottle%2C%20soft%20natural%20lighting%2C%20minimalist%20cream%20background%2C%20professional%20beauty%20photography%2C%20elegant%20pose%2C%20dewy%20makeup%20look%2C%20natural%20beauty%20concept&width=1200&height=500&seq=hero1&orientation=landscape',
                    title: 'Temukan Kecantikan Alami Anda',
                    subtitle: 'Produk kecantikan premium dengan bahan alami pilihan untuk merawat kulit Indonesia yang cantik'
                },
                {
                    image: 'https://i.pinimg.com/736x/f1/0f/85/f10f857f68a5771a4a9b98b940cd0795.jpg',
                    title: 'Perawatan Premium untuk Kulit Sehat',
                    subtitle: 'Rangkaian produk berkualitas tinggi yang telah teruji dermatologi untuk hasil optimal'
                },
                {
                    image: 'https://readdy.ai/api/search-image?query=Natural%20beauty%20portrait%20of%20confident%20woman%2C%20radiant%20glowing%20skin%2C%20soft%20natural%20makeup%2C%20clean%20minimalist%20background%2C%20professional%20beauty%20photography%2C%20healthy%20skin%20concept&width=1200&height=500&seq=hero3&orientation=landscape',
                    title: 'Kecantikan yang Bersinar dari Dalam',
                    subtitle: 'Formula khusus dengan bahan alami untuk merawat dan melindungi kulit Anda setiap hari'
                }
            ];
            
            let currentSlide = 0;
            const backgroundDiv = heroSection.querySelector('.absolute.inset-0');
            const titleElement = heroSection.querySelector('h2');
            const subtitleElement = heroSection.querySelector('p');
            
            if(backgroundDiv && titleElement && subtitleElement) {
                function changeSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    const slide = slides[currentSlide];
                    
                    backgroundDiv.style.backgroundImage = `url('${slide.image}')`;
                    titleElement.textContent = slide.title;
                    subtitleElement.textContent = slide.subtitle;
                }
                setInterval(changeSlide, 5000);
            }
        }
    });
</script>
@endpush

@endsection