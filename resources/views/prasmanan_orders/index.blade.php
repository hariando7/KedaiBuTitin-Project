<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white">
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
    </script>
    @endif

    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="flex overflow-hidden rounded-lg border border-gray-200 text-gray-100">
                <li class="flex items-center">
                    <div
                        class="flex h-12 items-center transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.index']) ? 'bg-gray-100 dark:bg-orange-400 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ms-1.5 text-xs font-medium">Daftar Pesanan</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('prasmanan_orders.create') }}"
                class="btn border-none bg-gray-700 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.index']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-white px-4 transition hover:text-gray-900">
                Tambah Pesanan</a>
            <a href="{{ route('prasmanan_stocks.index') }}"
                class="btn border-none bg-gray-700 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.index']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-white px-4 transition hover:text-gray-900">Kelola
                Stok Menu</a>
            <a href="{{ route('prasmanan_orders.index') }}"
                class="btn border-none bg-gray-700 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.index']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-white px-4 transition hover:text-gray-900">Kelola
                Pesanan</a>
        </div>
    </div>
    <div class="flex justify-between mt-5">
        <h1 class=" text-4xl text-black dark:text-orange-900">Pesanan Kedai Ibu Titin</h1>
        {{-- <a href="{{ route('prasmanan_orders.create') }}"
            class="btn border-none dark:bg-orange-700 text-black dark:text-white">Tambah
            Pesanan</a> --}}
    </div>
    <form method="GET" action="{{ url()->current() }}" id="filter-form" class="mt-5 w-full">
        <div class="flex justify-between">
            <div class="flex w-full gap-2">
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="border border-orange-400 px-3 py-2 rounded text-black dark:text-orange-900"
                    placeholder="Tanggal Awal">
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="border border-orange-400 px-3 py-2 rounded text-black dark:text-orange-900"
                    placeholder="Tanggal Akhir">
                <script>
                    function setMaxDate() {
                            let offset = 7 * 60 * 60 * 1000;
                            let today = new Date(new Date().getTime() + offset);
                            let formattedToday = today.toISOString().split('T')[0];
                            document.getElementById('start_date').setAttribute('max', formattedToday);
                            document.getElementById('end_date').setAttribute('max', formattedToday);
                        }
                        window.onload = setMaxDate;
                </script>
                <button type=" button" id="today-button"
                    class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Tanggal Hari Ini</button>
                <button type="button" id="all-time-button"
                    class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Restart Filter</button>
            </div>
            <div class="flex justify-between gap-2 mt-2">
                <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                    class="border border-orange-400 px-3 py-2 rounded" placeholder="Cari Nama Menu">
                <button type="submit"
                    class="bg-gray-700 dark:bg-orange-700 text-white px-4 py-2 rounded">Filter/Cari</button>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('today-button').addEventListener('click', function () {
            let offset = 7 * 60 * 60 * 1000;
            let today = new Date(new Date().getTime() + offset);
            let formattedToday = today.toISOString().split('T')[0];
            
            document.getElementById('start_date').value = formattedToday;
            document.getElementById('end_date').value = formattedToday;
            document.getElementById('filter-form').submit();
            });
            document.getElementById('all-time-button').addEventListener('click', function () {
                let url = new URL(window.location.href);
                url.search = '';
                window.location.href = url.toString();
            });
            document.getElementById('search-input').addEventListener('input', function () {
                let searchInput = document.getElementById('search-input').value;
                if (searchInput === '') {
                    let url = new URL(window.location.href);
                    url.searchParams.delete('search');
                    window.history.replaceState({}, '', url.toString());
                }
            });
        });
        </script>
    </form>

    @php
    $menuStats = [];
    $totalOrders = 0;
    $totalRevenue = 0;

    foreach ($orders as $order) {
    $items = json_decode($order->items);
    $totalOrders += 1;

    foreach ($items as $item) {
    if (!isset($menuStats[$item->nama_menu])) {
    $menuStats[$item->nama_menu] = [
    'total_quantity' => 0,
    'total_revenue' => 0,
    ];
    }
    $itemTotal = $item->quantity * $item->harga_menu;
    $menuStats[$item->nama_menu]['total_quantity'] += $item->quantity;
    $menuStats[$item->nama_menu]['total_revenue'] += $itemTotal;
    $totalRevenue += $itemTotal;
    }
    }
    @endphp

    <div class="mt-5">
        <h2 class="text-xl font-bold text-black dark:text-orange-900">Rincian Menu Terjual:</h2>
        <table class="table-auto border border-orange-900">
            <thead>
                <tr class="text-black dark:text-orange-900">
                    <th class="border border-orange-400 px-4 py-2">Nama Menu</th>
                    <th class="border border-orange-400 px-4 py-2">Jumlah Terjual</th>
                    <th class="border border-orange-400 px-4 py-2">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuStats as $menuName => $stats)
                <tr>
                    <td class="border border-orange-400 px-4 py-2 text-black dark:text-orange-900">{{ $menuName }}</td>
                    <td class="border border-orange-400 px-4 py-2 text-black dark:text-orange-900">{{
                        $stats['total_quantity'] }} pcs</td>
                    <td class="border border-orange-400 px-4 py-2 text-black dark:text-orange-900">Rp {{
                        number_format($stats['total_revenue'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-black dark:text-orange-900">
                    <th class="border border-orange-400 px-4 py-2">Total</th>
                    <th class="border border-orange-400 px-4 py-2">{{ $totalOrders }} Pesanan</th>
                    <th class="border border-orange-400 px-4 py-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Items</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400 text-center">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">
                        No</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <th class="border px-4 py-2 text-black dark:text-orange-900">{{ $index + 1 }}</th>
                    <td class="border px-4 py-2 text-black dark:text-orange-900">
                        @php
                        $totalPrice = 0;
                        @endphp
                        @foreach(json_decode($order->items) as $item)
                        @php
                        $itemTotal = $item->quantity * $item->harga_menu;
                        $totalPrice += $itemTotal;
                        @endphp
                        <strong>Nama Menu:</strong> {{ $item->nama_menu }}<br>
                        <strong>Order:</strong> {{ $item->quantity }}<br>
                        <strong>Harga Menu:</strong> Rp {{ number_format($item->harga_menu, 0, ',', '.') }}<br>
                        <strong>Total Harga:</strong> Rp {{ number_format($itemTotal, 0, ',', '.') }}<br><br>
                        @endforeach
                    </td>
                    {{-- total harga --}}
                    <td class="border px-4 py-2 text-black dark:text-orange-900">Rp {{ number_format($totalPrice, 0,
                        ',', '.') }}</td>
                    {{--total harga --}}
                    <td class="border px-4 py-2 text-black dark:text-orange-900">
                        {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('Y-m-d H:i') }}
                    </td>
                    <td class="border px-4 py-2 text-center ">
                        <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
                            <a href="{{ route('prasmanan_orders.show', $order->id) }}"
                                class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="View Details">
                                <svg viewBox="0 0 24 24" class="w-5 h-5 text-black dark:text-orange-900" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M22 15C22 18.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M10 2C6.22876 2 4.34315 2 3.17157 3.17157C2 4.34315 2 5.22876 2 9"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M12 7C9.07268 7 7.08037 8.56222 5.89242 9.94021C5.29747 10.6303 5 10.9754 5 12C5 13.0246 5.29748 13.3697 5.89243 14.0598C7.08038 15.4378 9.07268 17 12 17C14.9273 17 16.9196 15.4378 18.1076 14.0598C18.7025 13.3697 19 13.0246 19 12C19 10.9754 18.7025 10.6303 18.1076 9.94021C17.5723 9.31933 16.8738 8.66106 16 8.12513"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <circle cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                        <path
                                            d="M10 22C9.65081 22 9.31779 22 9 21.9991M2 15C2 18.7712 2 19.6569 3.17157 20.8284C3.82475 21.4816 4.69989 21.7706 6 21.8985"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M14 2C14.3492 2 14.6822 2 15 2.00093M22 9C22 5.22876 22 4.34315 20.8284 3.17157C20.1752 2.51839 19.3001 2.22937 18 2.10149"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </a>
                            {{-- <a href="{{ route('prasmanan_orders.edit', $order->id) }}"
                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Edit Product">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a> --}}
                            <button class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Delete Product" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-5 h-5 text-black dark:text-orange-900" stroke-width="1.5"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            <div id="popup-modal" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-orange-400">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3 text-black dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 dark:text-white w-12 h-12 text-gray-500"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-white">Yakin
                                                Ingin Hapus Pesanan Ini?</h3>
                                            <form action="{{ route('prasmanan_orders.destroy', $order->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Ya, Hapus
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </td>
                    {{-- <th class="border px-4 py-2 text-black dark:text-orange-900">{{ $order->id }}</th> --}}
                    <th class="border px-4 py-2 text-black dark:text-orange-900">{{ $index + 1 }}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-black dark:text-white">
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Items</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Total Harga</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400">Tanggal Pesanan</th>
                    <th class="border px-4 py-2 bg-white dark:bg-orange-400 text-center">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">
                        No</th>
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