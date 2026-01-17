@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Pesanan Saya</h1>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600">No. Order</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Total</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr>
                    <td class="p-4 font-mono text-sm text-primary font-bold">{{ $order->order_number }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="p-4 text-sm font-bold text-gray-800">Rp {{ number_format($order->total_price) }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $order->status == 'paid' ? 'bg-green-100 text-green-600' : 
                               ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="p-4">
                        @if($order->status == 'pending')
                            <a href="{{ route('payment.show', $order->id) }}" class="text-sm bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700">Bayar</a>
                        @else
                            <span class="text-gray-400 text-sm">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection