<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
{
    // Validasi (Hapus 'category' dari required karena user tidak input manual)
    $request->validate([
        'name' => 'required|string|max:255',
        'series' => 'required', // Series wajib diisi
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Manipulasi: Set Category = Series
    $categoryValue = $request->series; 

    // Upload Gambar
    $imagePath = $request->file('image')->store('products', 'public');

    Product::create([
        'name' => $request->name,
        'category' => $categoryValue, // <-- AUTO FILL
        'series' => $request->series, // <-- Simpan Series
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
        'is_featured' => $request->has('is_featured'),
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
}
    
    // Tambahkan fungsi destroy (hapus) untuk kelengkapan
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Ini sekarang akan melakukan Soft Delete (Aman)
        
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus (arsip)');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validasi (Hapus 'category' dari validasi karena tidak ada inputnya)
    $request->validate([
        'name' => 'required|string|max:255',
        'series' => 'required', // Wajib pilih series
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Data Dasar
    $data = [
        'name' => $request->name,
        'series' => $request->series,
        'category' => $request->series, // <-- TRIK: Isi category dengan nilai series
        'price' => $request->price,
        'description' => $request->description,
        'is_featured' => $request->has('is_featured'),
    ];

    // Cek Gambar Baru
    if ($request->hasFile('image')) {
        if ($product->image && \Illuminate\Support\Facades\Storage::exists('public/' . $product->image)) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
}

}