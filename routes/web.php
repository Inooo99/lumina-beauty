<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;

// --- FRONTEND (USER) ---
Route::get('/search-products', [App\Http\Controllers\HomeController::class, 'search'])->name('products.search');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/series/{slug}', [App\Http\Controllers\HomeController::class, 'series'])->name('series.show');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('product.detail');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{id}', [CheckoutController::class, 'showPayment'])->name('payment.show');
Route::get('/payment/success/{id}', [CheckoutController::class, 'success'])->name('payment.success');
Route::patch('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [App\Http\Controllers\OrderHistoryController::class, 'index'])->name('orders.index');
});
Route::get('/tips/{slug}', [App\Http\Controllers\HomeController::class, 'tips'])->name('tips.show');

// --- AUTHENTICATION (LOGIN MANUAL) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- AUTH CUSTOMER ---
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'processRegister'])->name('customer.register.post');

Route::get('/login-member', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/login-member', [CustomerAuthController::class, 'processLogin'])->name('customer.login.post');

// Overwrite route logout agar universal
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

// --- BACKEND (ADMIN) ---
// Dilindungi middleware 'auth' (harus login dulu)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard redirect ke products saja agar simpel
    Route::get('/', function () { return redirect()->route('admin.products.index'); })->name('dashboard');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update');

    // Route CRUD Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/fix-category-error', function () {
    try {
        // Perintah SQL untuk mengubah paksa kolom category menjadi Text Bebas
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE products MODIFY COLUMN category VARCHAR(255)");
        return "<h1>SUKSES! 🎉</h1> <p>Database berhasil diperbaiki. Kolom category sekarang bisa menerima teks apa saja (termasuk 'brightening'). Silakan coba input produk lagi.</p>";
    } catch (\Exception $e) {
        return "<h1>GAGAL :(</h1> <p>Error: " . $e->getMessage() . "</p>";
    }
});