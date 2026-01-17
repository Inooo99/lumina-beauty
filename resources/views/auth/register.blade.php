@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-secondary">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-sm">
        <div class="text-center">
            <h2 class="font-pacifico text-3xl text-gray-800">Daftar Member</h2>
            <p class="mt-2 text-sm text-gray-600">Buat akun untuk melacak pesanan Anda</p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('customer.register.post') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input name="name" type="text" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input name="email" type="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">No. WhatsApp</label>
                    <input name="phone" type="text" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <input name="password" type="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
            </div>

            <button type="submit" class="w-full bg-gray-800 text-white py-3 rounded-button font-bold hover:bg-gray-700 transition-colors">
                Daftar Sekarang
            </button>

            <div class="text-center text-sm">
                Sudah punya akun? <a href="{{ route('customer.login') }}" class="font-medium text-primary hover:text-gray-800">Login disini</a>
            </div>
        </form>
    </div>
</div>
@endsection