<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Produk Unggulan (Carousel/Slider Paling Atas)
        $featured_products = Product::where('is_featured', true)->latest()->take(8)->get();

        // 2. Ambil Produk per Series (Untuk Tab)
        $brightening_products = Product::where('series', 'brightening')->latest()->take(4)->get();
        $antiaging_products = Product::where('series', 'anti_aging')->latest()->take(4)->get();
        $acne_products = Product::where('series', 'acne_care')->latest()->take(4)->get();

        return view('frontend.home', compact(
            'featured_products', 
            'brightening_products', 
            'antiaging_products', 
            'acne_products'
        ));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Opsional: Ambil produk terkait (Related Products) dari kategori yang sama
        $related_products = Product::where('category', $product->category)
            ->where('id', '!=', $id) // Jangan tampilkan produk yang sedang dibuka
            ->take(4)
            ->get();

        return view('frontend.product-detail', compact('product', 'related_products'));
    }

    public function series($slug)
    {
        // Ambil produk berdasarkan series yang dipilih
        $products = Product::where('series', $slug)->latest()->get();

        // Ubah slug jadi Judul Cantik (misal: anti_aging jadi Anti Aging Series)
        $title = ucwords(str_replace('_', ' ', $slug)) . ' Series';

        return view('frontend.series-detail', compact('products', 'title'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Jika ketikan kosong, jangan kembalikan apa-apa
        if(!$query) {
            return '';
        }

        // Cari produk yang namanya MIRIP (%LIKE%) dengan ketikan user
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('series', 'LIKE', "%{$query}%") // Cari di series juga
                            ->limit(5) // Batasi cuma 5 hasil biar ga kepanjangan
                            ->get();

        // Kita return HTML langsung biar gampang ditampilkan
        $output = '';
        
        if($products->count() > 0) {
            $output .= '<div class="absolute w-full bg-white mt-2 rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">';
            foreach($products as $product) {
                // Link menuju detail produk
                $link = route('product.detail', $product->id);
                $image = asset('storage/' . $product->image);
                $price = number_format($product->price, 0, ',', '.');
                
                // PERBAIKAN DISINI: Menggunakan kutip satu (') untuk class HTML agar aman
                $output .= "
                <a href='$link' class='block px-4 py-3 hover:bg-gray-50 flex items-center gap-3 transition-colors'>
                    <img src='$image' class='w-10 h-10 object-cover rounded'>
                    <div>
                        <div class='text-sm font-bold text-gray-800'>$product->name</div>
                        <div class='text-xs text-primary'>Rp $price</div>
                    </div>
                </a>
                ";
            }
            $output .= '</div>';
        } else {
            $output .= '<div class="absolute w-full bg-white mt-2 rounded-lg shadow-xl border border-gray-100 z-50 p-4 text-sm text-gray-500 text-center">Produk tidak ditemukan</div>';
        }

        return $output;
    }

    public function tips($slug)
{
    // DATABASE ARTIKEL MANUAL (ARRAY)
    $articles = [
        'skincare-routine' => [
            'title' => '5 Langkah Skincare Routine untuk Pemula',
            'date' => '15 Januari 2026',
            'image' => 'https://i.pinimg.com/736x/7b/ac/29/7bac299de8fc55844950597dacf6b85e.jpg',
            'content' => '
                <p class="mb-4">Memulai perawatan wajah tidak perlu ribet. Berikut adalah urutan dasar yang wajib kamu lakukan setiap hari:</p>
                <ol class="list-decimal pl-5 space-y-4 mb-6">
                    <li><strong>Double Cleansing:</strong> Bersihkan wajah dengan oil cleanser lalu ikuti dengan facial wash untuk mengangkat sisa makeup dan debu secara tuntas.</li>
                    <li><strong>Toner:</strong> Gunakan toner untuk menyeimbangkan pH kulit setelah mencuci muka dan mempersiapkan kulit menerima skincare selanjutnya.</li>
                    <li><strong>Serum:</strong> Ini adalah inti perawatan. Pilih serum sesuai masalah kulit (Vitamin C untuk mencerahkan, Retinol untuk anti-aging).</li>
                    <li><strong>Moisturizer:</strong> Kunci kelembapan wajah dengan pelembap, baik untuk kulit kering maupun berminyak.</li>
                    <li><strong>Sunscreen (Pagi Hari):</strong> Langkah terpenting! Jangan lupa gunakan tabir surya minimal SPF 30 untuk melindungi kulit dari sinar UV.</li>
                </ol>
                <p>Lakukan secara konsisten minimal 2 minggu untuk melihat hasilnya!</p>
            '
        ],
        'natural-makeup' => [
            'title' => 'Tutorial Natural Makeup ala Korea',
            'date' => '12 Januari 2026',
            'image' => 'https://readdy.ai/api/search-image?query=Natural%20makeup%20look%20tutorial%2C%20Korean%20glass%20skin%20makeup%2C%20soft%20natural%20lighting%2C%20beauty%20blogger%20applying%20makeup%2C%20professional%20beauty%20photography%2C%20minimalist%20makeup%20concept&width=400&height=200&seq=article2&orientation=landscape',
            'content' => '
                <p class="mb-4">Ingin tampil cantik tapi terlihat "seperti tidak pakai makeup"? Simak rahasianya:</p>
                <ul class="list-disc pl-5 space-y-4 mb-6">
                    <li><strong>Skin Prep:</strong> Pastikan wajah lembap agar makeup menempel sempurna. Kulit yang sehat adalah kunci "Glass Skin".</li>
                    <li><strong>Cushion Ringan:</strong> Hindari foundation tebal. Gunakan cushion atau BB cream dengan coverage medium.</li>
                    <li><strong>Alis Lurus:</strong> Gambar alis mengikuti bentuk alami atau sedikit lurus untuk kesan lebih muda.</li>
                    <li><strong>Blush On Demam:</strong> Sapukan blush on warna peach atau pink muda tepat di bawah mata.</li>
                    <li><strong>Ombre Lips:</strong> Gunakan liptint warna terang di bagian dalam bibir dan ratakan ke luar.</li>
                </ul>
                <p>Kunci dari natural makeup adalah <em>less is more</em>!</p>
            '
        ],
        'active-ingredients' => [
            'title' => 'Kamus Skincare: Mengenal Bahan Aktif',
            'date' => '10 Januari 2026',
            'image' => 'https://readdy.ai/api/search-image?query=Skincare%20ingredients%20knowledge%2C%20vitamin%20C%20serum%20science%2C%20laboratory%20research%2C%20professional%20educational%20photography%2C%20beauty%20science%20concept%2C%20clean%20modern%20setting&width=400&height=200&seq=article3&orientation=landscape',
            'content' => '
                <p class="mb-4">Sering bingung membaca komposisi produk? Berikut bahan aktif populer dan fungsinya:</p>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <strong>1. Niacinamide:</strong> Jagoan untuk mencerahkan kulit kusam, menyamarkan noda hitam, dan mengontrol minyak.
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <strong>2. Salicylic Acid (BHA):</strong> Sahabat kulit berjerawat. Masuk ke dalam pori-pori untuk membersihkan sumbatan dan komedo.
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <strong>3. Hyaluronic Acid:</strong> Magnet air. Menarik kelembapan ke dalam kulit, membuat wajah kenyal dan terhidrasi.
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <strong>4. Retinol:</strong> Gold standard untuk anti-aging. Mempercepat regenerasi sel kulit dan menyamarkan kerutan halus.
                    </div>
                </div>
                <p class="mt-4">Jangan asal campur bahan aktif ya! Konsultasikan jika kulitmu sensitif.</p>
            '
        ]
    ];

    // Cek apakah slug ada di data kita
    if (!array_key_exists($slug, $articles)) {
        abort(404); // Jika tidak ada, tampilkan error 404
    }

    $article = $articles[$slug];

    return view('frontend.tips-detail', compact('article'));
}
} 