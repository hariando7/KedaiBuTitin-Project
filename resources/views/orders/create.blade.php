<!-- resources/views/orders/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white">
    @if(session('error'))
    <div class="bg-red-500 text-white p-3 mb-4 rounded">
        {{ session('error') }}
    </div>
    @endif
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900">
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
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['orders.create']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        Tambah pesanan
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('orders.index') }}"
                class="btn border-none dark:bg-orange-700 text-black dark:text-white">Kelola
                Pesanan</a>
            <a href="{{ route('orders.report') }}"
                class="btn border-none dark:bg-orange-700 text-black dark:text-white">Laporan
                Pesanan</a>
        </div>
    </div>
    <div class="flex gap-5">
        <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Tambah Pesanan</h1>
    </div>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            @php
            $menus = $menus->sortBy('nama_menu');
            @endphp
            <label for="menu_id" class="block text-gray-700">Nama Menu</label>
            <select name="menu_id" id="menu_id" class="w-full px-4 py-2 border rounded-lg border-gray-300" required>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}" data-harga="{{ $menu->harga_menu }}">{{ $menu->nama_menu }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="jumlah_pesanan" class="block text-gray-700">Jumlah Pesanan</label>
            <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" required
                class="peer h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 placeholder-transparent sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="harga_menu" class="block text-gray-700">Harga Menu</label>
            <select name="harga_pesanan" id="harga_pesanan" class="w-full px-4 py-2 border rounded-lg border-gray-300"
                required>
                @for ($i = 1000; $i <= 30000; $i +=1000) <option value="{{ $i }}">Rp. {{ number_format($i, 0, ',', '.')
                    }}</option>
                    @endfor
            </select>
        </div>
        <div class="mb-4">
            <label for="catatan_pesanan"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="catatan_pesanan" placeholder="Masukkan Catatan Menu" name="catatan_pesanan"
                    value="Tidak Ada Catatan"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required />
                <span
                    class="absolute start-3 top-3 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs">
                    Masukkan Catatan (Opsional)
                </span>
            </label>
        </div>
        <button type="submit"
            class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
            <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
            <span
                class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                Tambah Pesanan
            </span>
        </button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const menuSelect = document.getElementById('menu_id');
        const hargaSelect = document.getElementById('harga_pesanan');
    
        menuSelect.addEventListener('change', function() {
            const selectedOption = menuSelect.options[menuSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const namaMenu = selectedOption.textContent.toLowerCase();
    
            if (namaMenu.includes('ricebowl')) {
                hargaSelect.value = 5000;
            } else {
                hargaSelect.value = harga || '';
            }
        });
    
        menuSelect.dispatchEvent(new Event('change'));
    });
    </script>

</div>
@endsection