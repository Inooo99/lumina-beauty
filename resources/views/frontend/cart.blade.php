@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-4 font-semibold text-gray-600">Produk</th>
                            <th class="p-4 font-semibold text-gray-600">Harga</th>
                            <th class="p-4 font-semibold text-gray-600">Qty</th>
                            <th class="p-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $total = 0; @endphp
                        
                        @foreach(session('cart') as $id => $details)
                        
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr>
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden">
                                        <img src="{{ asset('storage/'.$details['image']) }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $details['name'] }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-gray-600">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            
                            <td class="p-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" 
                                           class="w-16 border border-gray-300 rounded text-center p-1 text-sm focus:ring-primary focus:border-primary"
                                           onchange="this.form.submit()">
                                </form>
                            </td>

                            <td class="p-4">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan</h3>
                    <div class="flex justify-between items-center mb-4 text-gray-600">
                        <span>Total Belanja</span>
                        <span class="font-bold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr class="border-gray-100 mb-6">
                    <a href="{{ route('checkout.index') }}" class="block w-full text-center bg-gray-800 text-white py-3 rounded-button font-bold hover:bg-gray-700 transition-colors">
                        Checkout Sekarang
                    </a>
                    <a href="{{ route('home') }}" class="block text-center mt-4 text-sm text-gray-500 hover:text-primary">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-secondary rounded-xl">
            <div class="mb-4">
                <i class="ri-shopping-cart-line text-6xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Keranjang Anda Kosong</h3>
            <p class="text-gray-500 mb-8">Yuk, isi dengan produk kecantikan favoritmu!</p>
            <a href="{{ route('home') }}" class="inline-block bg-primary text-gray-800 px-8 py-3 rounded-button font-bold hover:bg-opacity-90">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection