@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Pesanan Masuk</h1>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-4">Order ID</th>
                    <th class="p-4">Pembeli</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Ubah Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-mono">{{ $order->order_number }}</td>
                    <td class="p-4">
                        <div class="font-bold">{{ $order->customer_name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->customer_email }}</div>
                    </td>
                    <td class="p-4">Rp {{ number_format($order->total_price) }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded text-xs font-bold bg-gray-200">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection