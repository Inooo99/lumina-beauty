@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-secondary">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-sm">
        <div class="text-center">
            <h2 class="font-pacifico text-3xl text-gray-800">Login Member</h2>
            <p class="mt-2 text-sm text-gray-600">Masuk untuk melihat pesanan Anda</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-500 text-sm p-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif
        
        <form class="mt-8 space-y-6" action="{{ route('customer.login.post') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input name="email" type="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <input name="password" type="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary mt-1">
                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-gray-800 py-3 rounded-button font-bold hover:bg-opacity-90 transition-colors">
                Masuk
            </button>

            <div class="text-center text-sm">
                Belum punya akun? <a href="{{ route('customer.register') }}" class="font-medium text-gray-600 underline hover:text-gray-800">Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>
@endsection