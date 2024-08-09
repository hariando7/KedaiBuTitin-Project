<!-- resources/views/menus/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white=">
    <a href="{{ route('menus.index') }}"
        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring mb-10" href="#">
        <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
        <span
            class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
            Kembali
        </span>
    </a>
    <div class="flex justify-between">
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
    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Edit Menu</h1>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4 mt-10">
            <div>
                <label for="nama_menu" class="block text-sm font-medium text-gray-900">Nama Menu</label>
                <div class="relative mt-1.5">
                    <select id="nama_menu" name="nama_menu"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm p-2 h-10" required>
                        <option value="" disabled>Pilih Nama Menu</option>
                        <option value="Ayam Bakar Tanpa Nasi" data-jenis="Makanan" {{ $menu->
                            nama_menu == 'Ayam Bakar Tanpa Nasi' ? 'selected' : '' }}>Ayam Bakar Tanpa Nasi</option>
                        <option value="Ayam Bakar Nasi" data-jenis="Makanan" {{ $menu->nama_menu ==
                            'Ayam Bakar Nasi' ? 'selected' : '' }}>Ayam Bakar Nasi</option>
                        <option value="Ayam Penyet Tanpa Nasi" data-jenis="Makanan" {{ $menu->
                            nama_menu == 'Ayam Penyet Tanpa Nasi' ? 'selected' : '' }}>Ayam Penyet Tanpa Nasi</option>
                        <option value="Ayam Penyet Nasi" data-jenis="Makanan" {{ $menu->nama_menu ==
                            'Ayam Penyet Nasi' ? 'selected' : '' }}>Ayam Penyet Nasi</option>
                        <option value="Ayam Geprek Komplit" data-jenis="Makanan" {{ $menu->nama_menu
                            == 'Ayam Geprek Komplit' ? 'selected' : '' }}>Ayam Geprek Komplit</option>
                        <option value="Ayam Geprek Hemat" data-jenis="Makanan" {{ $menu->nama_menu ==
                            'Ayam Geprek Hemat' ? 'selected' : '' }}>Ayam Geprek Hemat</option>
                        <option value="Ricebowl" data-jenis="Makanan" {{ $menu->nama_menu ==
                            'Ricebowl' ? 'selected' : '' }}>Ricebowl</option>
                        <option value="Kue" data-jenis="Kue" {{ $menu->nama_menu == 'Kue' ? 'selected'
                            : '' }}>Kue</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div>
                <label for="jenis_menu" class="block text-sm font-medium text-gray-900">Jenis Menu</label>
                <div class="relative mt-1.5">
                    <select id="jenis_menu" name="jenis_menu"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm p-2 h-10" required>
                        <option value="" disabled>Pilih Jenis Menu</option>
                        <option value="Makanan" {{ $menu->jenis_menu == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ $menu->jenis_menu == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Kue" {{ $menu->jenis_menu == 'Kue' ? 'selected' : '' }}>Kue</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="catatan_menu"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="catatan_menu" placeholder="Masukkan Catatan Menu" name="catatan_menu"
                    value="{{ $menu->catatan_menu }}"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" />
                <span
                    class="absolute start-3 top-3 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs">
                    Masukkan Catatan (Opsional)
                </span>
            </label>
        </div>
        <div class="flex justify-between mt-10">
            <button type="submit"
                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring"
                href="#">
                <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
                <span
                    class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                    Edit
                </span>
            </button>
        </div>
    </form>

</div>
@endsection