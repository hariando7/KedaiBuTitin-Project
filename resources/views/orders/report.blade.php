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
    <div class="flex justify-between mb-10">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div
                        class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900 {{ Request::routeIs(['orders.index']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ms-1.5 text-xs font-medium">Daftar Pesanan</span>
                    </div>
                </li>
                <li class="relative flex items-center">
                    <span
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                    </span>
                    <div
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900">
                        Tambah Pesanan
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('orders.create') }}"
                class="btn border-none bg-white text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['orders.create']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Menu
                Home</a>
            <a href="{{ route('menus.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['menus.index']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kelola
                Menu</a>
            <a href="{{ route('stocks.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['stocks.index']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kelola
                Stok Menu</a>
            <a href="{{ route('orders.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['orders.index']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kelola
                Pesanan</a>
            <a href="{{ route('orders.report') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['orders.report']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Rekap
                Kedai Ibu Titin</a>
        </div>
    </div>
    <div class="flex justify-between">
        <h1 class="text-4xl text-black dark:text-orange-900">Rekapitulasi Laporan Pesanan Kedai Ibu Titin</h1>
        <form method="GET" action="{{ route('orders.export') }}" class="justify-center items-center">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <button type="submit" class="bg-gray-700 dark:bg-green-500 text-white px-4 py-2 rounded">Unduh
                Excel</button>
        </form>
    </div>
    <div class="mt-5">
        <form method="GET" action="{{ url()->current() }}" id="filter-form" class="mt-5 w-full">
            <div class="flex justify-between">
                <div class="flex w-full gap-2">
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                        class="border px-3 py-2 rounded" placeholder="Tanggal Awal">
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                        class="border px-3 py-2 rounded" placeholder="Tanggal Akhir">
                    <button type="button" id="today-button"
                        class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Tanggal Hari Ini</button>
                    <button type="button" id="all-time-button"
                        class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Restart Filter</button>
                </div>
                <div class="flex justify-between gap-2 mt-2">
                    <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                        class="border px-3 py-2 rounded" placeholder="Cari Nama Menu">
                    <button type="submit"
                        class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Filter/Cari</button>
                </div>
            </div>
            <script>
                document.getElementById('today-button').addEventListener('click', function(event) {
                    var today = new Date().toISOString().split('T')[0];
                    document.getElementById('start_date').value = today;
                    document.getElementById('end_date').value = today;
                    document.getElementById('filter-form').submit();
                });
                document.getElementById('all-time-button').addEventListener('click', function() {
                    var url = new URL(window.location.href);
                    url.searchParams.delete('start_date');
                    url.searchParams.delete('end_date');
                    url.searchParams.delete('search'); 
                    window.location.href = url.toString();
                });
                document.getElementById('search-input').addEventListener('input', function() {
                    var searchInput = document.getElementById('search-input').value;
                    if (searchInput === '') {
                        var url = new URL(window.location.href);
                        url.searchParams.delete('search');
                        window.location.href = url.toString();
                    }
                });
            </script>
        </form>
    </div>

    <div class="mt-5">
        <h2 class="text-xl font-bold">Total Jumlah Pesanan: {{ $totalQuantity }}</h2>
        <h2 class="text-xl font-bold">Total Pendapatan: Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
    </div>

    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="text-black font-bold border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ $order->menu->nama_menu }}</td>
                    <td class="border px-4 py-2">{{ $order->jumlah_pesanan }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->harga_pesanan, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->jumlah_pesanan * $order->harga_pesanan, 0,
                        ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at }}</td>
                    <td class="border px-4 py-2">{{ $order->catatan_pesanan }}</td>
                    <th class="border px-4 py-2" style="display:none;">{{ $order->id }}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->appends(request()->except('page'))->links() }}
    </div>
</div>
@endsection