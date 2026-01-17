@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Checkout Pengiriman</h1>

    <div class="grid md:grid-cols-2 gap-12">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 h-fit">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="ri-map-pin-line text-primary"></i> Alamat Pengiriman
            </h3>
            
            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="customer_name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="customer_email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                    <input type="text" name="customer_phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Jalan, No. Rumah, Kecamatan, Kota...">{{ Auth::check() ? Auth::user()->address : '' }}</textarea>
                </div>

                <button type="submit" class="w-full bg-gray-800 text-white py-4 rounded-button font-bold text-lg hover:bg-gray-700 transition-colors shadow-lg mt-4">
                    Buat Pesanan
                </button>
            </form>
        </div>

        <div class="bg-gray-50 p-8 rounded-xl h-fit sticky top-24">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h3>
            
            <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2">
                @php $total = 0; @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <div class="flex items-center gap-4 bg-white p-4 rounded-lg shadow-sm">
                        <div class="w-16 h-16 rounded-md bg-gray-200 overflow-hidden flex-shrink-0">
                             <img src="{{ asset('storage/'.$details['image']) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">{{ $details['name'] }}</h4>
                            <p class="text-gray-500 text-xs">{{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="font-bold text-gray-800 text-sm">
                            Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="border-t border-gray-200 pt-4 space-y-2">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Ongkos Kirim</span>
                    <span class="text-green-600 font-medium">Gratis</span>
                </div>
                <div class="flex justify-between text-xl font-bold text-gray-800 pt-4 border-t border-gray-200 mt-4">
                    <span>Total Bayar</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection