@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-800">
            <i class="ri-arrow-left-line text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Produk</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-bold">Ada kesalahan input!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Kategori Series <span class="text-red-500">*</span></label>
                    <select name="series" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary">
                        <option value="">-- Pilih Series --</option>
                        <option value="brightening" {{ (old('series', $product->series) == 'brightening') ? 'selected' : '' }}>Brightening Series</option>
                        <option value="anti_aging" {{ (old('series', $product->series) == 'anti_aging') ? 'selected' : '' }}>Anti-Aging Series</option>
                        <option value="acne_care" {{ (old('series', $product->series) == 'acne_care') ? 'selected' : '' }}>Acne Care Series</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Produk akan otomatis masuk ke halaman series yang dipilih.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2">
                @if($product->image)
                    <div class="mt-2 p-2 border rounded bg-gray-50 inline-block">
                        <p class="text-xs text-gray-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/'.$product->image) }}" class="h-24 w-24 object-cover rounded-lg">
                    </div>
                @endif
            </div>

            <div class="flex items-center bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                <input id="is_featured" name="is_featured" type="checkbox" {{ $product->is_featured ? 'checked' : '' }} class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                <label for="is_featured" class="ml-2 block text-sm font-semibold text-gray-800">
                    Jadikan Produk Unggulan (Tampil di Carousel Atas)
                </label>
            </div>

            <button type="submit" class="w-full bg-primary text-gray-800 font-bold py-3 rounded-button hover:bg-opacity-90 shadow-sm transition-colors">
                Update Produk
            </button>
        </form>
    </div>
</div>
@endsection