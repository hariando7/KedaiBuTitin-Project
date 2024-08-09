<!-- resources/views/menus/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white">
    <a href="{{ route('menus.index') }}"
        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring mb-10" href="#">
        <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
        <span
            class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
            Kembali
        </span>
    </a>
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
                        <span class="ms-1.5 text-xs font-medium">Menu</span>
                    </div>
                </li>
                <li class="relative flex items-center">
                    <span
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                    </span>
                    <div
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['menus.create']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        Tambah Menu
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Tambah Menu</h1>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="mb-4 mt-10">
            <div>
                <label for="nama_menu" class="block text-sm font-medium text-gray-900">Nama Menu</label>
                <div class="relative mt-1.5">
                    <select id="nama_menu" name="nama_menu"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm p-2 h-10" required>
                        <option value="" disabled selected>Pilih Nama Menu</option>
                        <option value="Ayam Bakar Tanpa Nasi" data-jenis="Makanan">Ayam Bakar Tanpa
                            Nasi</option>
                        <option value="Ayam Bakar Nasi" data-jenis="Makanan">Ayam Bakar Nasi</option>
                        <option value="Ayam Penyet Tanpa Nasi" data-jenis="Makanan">Ayam Penyet Tanpa
                            Nasi</option>
                        <option value="Ayam Penyet Nasi" data-jenis="Makanan">Ayam Penyet Nasi
                        </option>
                        <option value="Ayam Geprek Komplit" data-jenis="Makanan">Ayam Geprek Komplit
                        </option>
                        <option value="Ayam Geprek Hemat" data-jenis="Makanan">Ayam Geprek Hemat
                        </option>
                        <option value="Ricebowl" data-jenis="Makanan">Ricebowl</option>
                        <option value="Kue" data-jenis="Kue">Kue</option>
                        <option value="Prasmanan" data-jenis="Makanan">Prasmanan</option>
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
                        <option value="" disabled selected>Pilih Jenis Menu</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Kue">Kue</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="catatan_menu"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="catatan_menu" placeholder="Masukkan Catatan Menu" name="catatan_menu"
                    value="Tidak Ada Catatan"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required />
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
                    Tambah Menu
                </span>
            </button>
        </div>
    </form>
</div>
@endsection