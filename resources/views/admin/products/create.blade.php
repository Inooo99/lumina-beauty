@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-800">
            <i class="ri-arrow-left-line text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Contoh: Vitamin C Serum">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Series (Opsional)</label>
                <select name="series" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary">
                    <option value="none">Tidak Ada Series</option>
                    <option value="brightening">Brightening Series</option>
                    <option value="anti_aging">Anti-Aging Series</option>
                    <option value="acne_care">Acne Care Series</option>
                </select>
            </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="150000">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Jelaskan manfaat produk ini..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Produk</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="ri-upload-cloud-2-line text-3xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> gambar produk</p>
                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                        </div>
                        <input id="dropzone-file" name="image" type="file" class="hidden" required />
                    </label>
                </div>
            </div>

            <div class="pt-4">
            <div class="flex items-center mb-6">
                <input id="is_featured" name="is_featured" type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                <label for="is_featured" class="ml-2 block text-sm font-semibold text-gray-700">
                    Jadikan Produk Unggulan (Tampil di Homepage Atas)
                </label>
            </div>
            <div class="flex items-center mb-6">
                <button type="submit" class="w-full bg-primary text-gray-800 font-bold py-3 px-4 rounded-button hover:bg-opacity-90 transition-colors shadow-sm">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection