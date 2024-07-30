<!-- resources/views/orders/report.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white">
    @if(session('success'))
    <div class="bg-green-500 text-white p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-500 text-white p-3 mb-4 rounded">
        {{ session('error') }}
    </div>
    @endif

    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Laporan Pesanan Kedai Ibu Titin</h1>

    <div class="lg:flex justify-between mt-5">
        <form method="GET" action="{{ route('orders.report') }}" class="">
            <div class="flex gap-4">
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="border px-3 py-2 rounded" placeholder="Tanggal Awal" required>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border px-3 py-2 rounded"
                    placeholder="Tanggal Akhir" required>
                <input type="text" name="search" value="{{ request('search') }}" class="border px-3 py-2 rounded"
                    placeholder="Cari Nama Menu">
                <button type="submit"
                    class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Filter</button>
            </div>
        </form>
        <!-- Button for exporting to Excel -->
        <form method="GET" action="{{ route('orders.export') }}" class="">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <button type="submit" class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Unduh
                Excel</button>
        </form>
    </div>

    <!-- Tampilkan total jumlah pesanan dan total pendapatan -->
    <div class="mt-5">
        <h2 class="text-xl font-bold">Total Jumlah Pesanan: {{ $totalQuantity }}</h2>
        <h2 class="text-xl font-bold">Total Pendapatan: Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
    </div>

    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr class="text-black dark:text-white">
                    <th class="font-bold border px-4 py-2 bg-white dark:bg-orange-400">ID</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="text-black font-bold border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ $order->menu->nama_menu }}</td>
                    <td class="border px-4 py-2">{{ $order->jumlah_pesanan }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->menu->harga_menu, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at }}</td>
                    <td class="border px-4 py-2">{{ $order->catatan_pesanan }}</td>
                    <td class="text-black font-bold border px-4 py-2">{{ $order->id }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">ID</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">ID</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $orders->appends(request()->except('page'))->links() }}
    </div>
</div>
@endsection