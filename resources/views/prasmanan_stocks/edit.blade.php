@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div class="flex h-10 items-center gap-1.5 bg-white dark:text-orange-900 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ms-1.5 text-xs font-medium">Stok Menu</span>
                    </div>
                </li>
                <li class="relative flex items-center">
                    <span
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180"></span>
                    <div
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium {{ Request::routeIs(['prasmanan_stocks.edit']) ? 'bg-gray-100 dark:bg-orange-400 text-gray-600 dark:text-white' : '' }}">
                        Edit Pesanan
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('prasmanan_stocks.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_stocks.edit']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kembali</a>
        </div>
    </div>

    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Edit Stok</h1>

    @if(session('error'))
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('prasmanan_stocks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nama_menu" class="block text-gray-700">Nama Menu</label>
            <input type="text" id="nama_menu" name="nama_menu" required value="{{ $prasmananStock->nama_menu }}"
                class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="stok_menu" class="block text-gray-700">Jumlah Stok</label>
            <input type="number" id="stok_menu" name="stok_menu" required value="{{ $prasmananStock->stok_menu }}"
                class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="tanggal_ditambahkan" class="block text-gray-700">Tanggal Ditambahkan</label>
            <input type="date" id="tanggal_ditambahkan" name="tanggal_ditambahkan" required
                value="{{ $prasmananStock->tanggal_ditambahkan }}"
                class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">
        </div>

        <div class="flex justify-between mt-10">
            <button type="submit"
                class="btn border-none bg-gray-700 dark:bg-green-600 text-white dark:text-white px-4 py-2 rounded">Edit
                Stok</button>
        </div>
    </form>
</div>
@endsection