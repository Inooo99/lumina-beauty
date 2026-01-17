@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>
            <p class="text-gray-600 text-sm">Kelola katalog produk LUMINA Beauty</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-gray-800 px-6 py-2.5 rounded-button font-bold text-sm hover:bg-opacity-90 transition-colors flex items-center gap-2">
            <i class="ri-add-line"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-secondary text-gray-700 text-sm uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b">Gambar</th>
                        <th class="p-4 font-semibold border-b">Nama Produk</th>
                        <th class="p-4 font-semibold border-b">Kategori</th>
                        <th class="p-4 font-semibold border-b">Harga</th>
                        <th class="p-4 font-semibold border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <div class="h-16 w-16 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover" alt="Img">
                            </div>
                        </td>
                        <td class="p-4 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-blue-600 py-1 px-3 rounded-full text-xs font-semibold uppercase">
                                {{ $product->category }}
                            </span>
                        </td>
                        <td class="p-4 font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 mr-2" title="Edit">
                                <i class="ri-pencil-line text-xl"></i>
                            </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="Hapus">
                                        <i class="ri-delete-bin-line text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Belum ada produk. Silakan tambah produk baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection