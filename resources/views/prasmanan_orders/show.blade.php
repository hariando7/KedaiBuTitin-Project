@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div class="flex h-10 items-center gap-1.5 bg-white px-4">
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
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180"></span>
                    <div
                        class="flex h-12 items-center bg-gray-100 pe-4 ps-8 text-xs font-medium {{ Request::routeIs(['orders.show']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white' : '' }}">
                        Detail Pesanan
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Detail Pesanan #{{ $order->id }}</h1>

    <div class="mb-4">
        <label class="block text-gray-700">Tanggal Pesanan</label>
        <p class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">{{
            $order->tanggal_pesanan }}</p>
    </div>

    <div id="items">
        @foreach(json_decode($order->items) as $item)
        <div class="mb-4">
            <label class="block text-gray-700">Nama Menu</label>
            <p class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">{{ $item->nama_menu
                }}</p>

            <label class="block text-gray-700 mt-2">Jumlah Menu</label>
            <p class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">{{ $item->quantity }}
            </p>

            <label class="block text-gray-700 mt-2">Harga Menu</label>
            <p class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">Rp {{
                number_format($item->harga_menu, 0, ',', '.') }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        <label class="block text-gray-700">Total Harga</label>
        <p class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">Rp {{
            number_format($order->total_harga, 0, ',', '.') }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('prasmanan_orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali ke
            Daftar Pesanan</a>
    </div>
</div>
@endsection