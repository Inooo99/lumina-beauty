<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUMINA Beauty - Kecantikan Alami Indonesia</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
    html { scroll-behavior: smooth; }
    :where([class^="ri-"])::before { content: "\f3c2"; }
    .font-pacifico { font-family: "Pacifico", serif; }
    .font-inter { font-family: "Inter", sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD6CC',
                        secondary: '#F5F3F0'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
</head>
<body class="font-inter bg-white">
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="font-pacifico text-2xl text-gray-800">LUMINA</a>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">
                    Home
                </a>

                <a href="{{ route('home') }}#featured" class="text-gray-700 hover:text-primary transition-colors font-medium">
                    Featured Products
                </a>
                
                <a href="{{ route('home') }}#series" class="text-gray-700 hover:text-primary transition-colors font-medium">
                    Series
                </a>
                
                <a href="{{ route('home') }}#tips" class="text-gray-700 hover:text-primary transition-colors font-medium">
                    Beauty Tips
                </a>
            </nav>
                
            <div class="flex items-center space-x-4">
            <div class="relative hidden sm:block">
    <input type="text" 
           id="search-input" 
           placeholder="Cari produk..." 
           autocomplete="off"
           class="w-64 pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all">
    
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <div class="w-4 h-4 flex items-center justify-center">
            <i class="ri-search-line text-gray-400 text-sm"></i>
        </div>
    </div>

    <div id="search-results" class="absolute left-0 w-full"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <script>
    $(document).ready(function(){
        
        // Saat user mengetik di kolom search
        $('#search-input').on('keyup', function(){
            var query = $(this).val(); 
            
            // Hanya cari jika minimal 2 huruf (biar server ga berat)
            if(query.length > 1){
                $.ajax({
                    url: "{{ route('products.search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data){
                        $('#search-results').html(data); // Tampilkan hasil
                    }
                });
            } else {
                $('#search-results').html(''); // Kosongkan jika dihapus
            }
        });

        // Klik di luar search bar akan menutup hasil
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.relative').length) {
                $('#search-results').html('');
            }
        });
    });
</script>
    
    @auth
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.products.index') }}" title="Dashboard Admin" class="w-8 h-8 flex items-center justify-center text-primary font-bold hover:text-gray-800 transition-colors">
                <i class="ri-admin-line"></i>
            </a>
            <a href="{{ route('admin.orders.index') }}" title="Kelola Pesanan" class="ml-2 w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors">
                <i class="ri-file-list-3-line"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                @csrf
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin logout?')" title="Logout Admin" class="text-red-500 hover:text-red-700 text-sm font-medium">
                    <i class="ri-logout-box-r-line"></i>
                </button>
            </form>

        @else
            <div class="relative">
                <button onclick="toggleUserMenu()" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors focus:outline-none">
                    <i class="ri-user-smile-line text-xl"></i>
                </button>

                <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary/10 hover:text-primary transition-colors">
                        <i class="ri-file-list-line mr-2"></i> Riwayat Pesanan
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin logout?')" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="ri-logout-box-r-line mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif

    @else
        <a href="{{ route('customer.login') }}" title="Login / Register" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors">
            <i class="ri-user-line"></i>
        </a>
    @endauth
    
    <a href="{{ route('cart.index') }}" class="relative w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors">
        <i class="ri-shopping-bag-line"></i>
        @if(session('cart'))
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                {{ count(session('cart')) }}
            </span>
        @endif
    </a>
</div>

<script>
    function toggleUserMenu() {
        const menu = document.getElementById('user-menu-dropdown');
        menu.classList.toggle('hidden');
    }

    // Menutup dropdown jika klik di luar area
    window.addEventListener('click', function(e) {
        const button = document.querySelector('button[onclick="toggleUserMenu()"]');
        const menu = document.getElementById('user-menu-dropdown');
        if (button && menu && !button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-50 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-pacifico text-xl text-gray-800 mb-4">LUMINA</h4>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Produk kecantikan premium dengan bahan alami pilihan untuk merawat kulit Indonesia yang cantik.
                    </p>
                    <div class="text-sm text-gray-600">
                        <div class="mb-2">Jl. Sudirman No. 123</div>
                        <div class="mb-2">Jakarta Selatan 12190</div>
                        <div>Indonesia</div>
                    </div>
                </div>
                
                <div>
                    <h5 class="font-semibold text-gray-800 mb-4">Tautan Cepat</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold text-gray-800 mb-4">Kategori Produk</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Skincare</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Makeup</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Body Care</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Hair Care</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Gift Sets</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold text-gray-800 mb-4">Ikuti Kami</h5>
                    <div class="flex space-x-3 mb-4">
                        <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg text-gray-600 hover:bg-primary hover:text-gray-800 transition-colors">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg text-gray-600 hover:bg-primary hover:text-gray-800 transition-colors">
                            <i class="ri-facebook-line"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg text-gray-600 hover:bg-primary hover:text-gray-800 transition-colors">
                            <i class="ri-twitter-line"></i>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-lg text-gray-600 hover:bg-primary hover:text-gray-800 transition-colors">
                            <i class="ri-youtube-line"></i>
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Customer Service:</p>
                    <p class="text-sm font-semibold text-gray-800">0800-1-LUMINA</p>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-600 mb-4 md:mb-0">
                        © 2026 LUMINA Beauty. Seluruh hak cipta dilindungi.
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-visa-fill text-gray-400"></i>
                        </div>
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-mastercard-fill text-gray-400"></i>
                        </div>
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-paypal-fill text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script id="mobile-menu">
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.createElement('button');
            mobileMenuButton.className = 'md:hidden w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors';
            mobileMenuButton.innerHTML = '<i class="ri-menu-line"></i>';
            
            const headerActions = document.querySelector('header .flex.items-center.space-x-4');
            headerActions.insertBefore(mobileMenuButton, headerActions.firstChild);
            
            const nav = document.querySelector('nav');
            const mobileNav = nav.cloneNode(true);
            mobileNav.className = 'md:hidden bg-white border-t border-gray-200 px-4 py-4 space-y-2 hidden';
            mobileNav.querySelectorAll('a').forEach(link => {
                link.className = 'block py-2 text-gray-700 hover:text-primary transition-colors';
            });
            
            document.querySelector('header > div').appendChild(mobileNav);
            
            mobileMenuButton.addEventListener('click', function() {
                mobileNav.classList.toggle('hidden');
                const icon = mobileMenuButton.querySelector('i');
                icon.className = mobileNav.classList.contains('hidden') ? 'ri-menu-line' : 'ri-close-line';
            });
        });
    </script>

    <script id="newsletter-form">
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.querySelector('section[class*="bg-primary"] .flex');
            if(newsletterForm){
                const emailInput = newsletterForm.querySelector('input[type="email"]');
                const submitButton = newsletterForm.querySelector('button');
                
                submitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const email = emailInput.value.trim();
                    if (!email) { alert('Mohon masukkan alamat email Anda'); return; }
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { alert('Mohon masukkan alamat email yang valid'); return; }
                    submitButton.textContent = 'Berlangganan...';
                    submitButton.disabled = true;
                    setTimeout(() => {
                        alert('Terima kasih! Anda telah berlangganan newsletter LUMINA Beauty');
                        emailInput.value = '';
                        submitButton.textContent = 'Berlangganan';
                        submitButton.disabled = false;
                    }, 1500);
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>