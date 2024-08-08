<!-- resources/views/orders/index.blade.php -->
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
    <div class="flex justify-between mb-5 mt-5">
        <h1 class=" text-4xl text-black dark:text-orange-900">Pesanan Kedai Ibu Titin</h1>
        <a href="{{ route('orders.create') }}"
            class="btn border-none dark:bg-orange-700 text-black dark:text-white">Tambah
            Pesanan</a>
    </div>
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
    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                <tr>
                    <th class="border px-4 py-2">{{ $index + 1 }}</th>
                    <td class="border px-4 py-2">{{ $order->menu->nama_menu }}</td>
                    <td class="border px-4 py-2">{{ $order->jumlah_pesanan }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->harga_pesanan, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->jumlah_pesanan * $order->harga_pesanan, 0,
                        ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at }}</td>
                    <td class="border px-4 py-2">{{ $order->catatan_pesanan }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Delete Product">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.086-2.25a51.964 51.964 0 00-3.328 0C9.91 2.71 9 3.694 9 4.874v.916m12 0a51.964 51.964 0 00-12 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                    <th class="border px-4 py-2" style="display:none;">{{ $order->id }}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Jumlah Pesanan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Harga Satuan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan
                    </th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Catatan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
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