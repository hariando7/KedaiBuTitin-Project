<!-- resources/views/menus/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white">
    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Tambah Menu</h1>
    <nav aria-label="Breadcrumb" class="flex">
        <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
            <li class="flex items-center">
                <a href="{{ route('menus.index') }}"
                    class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ms-1.5 text-xs font-medium">Menu</span>
                </a>
            </li>
            <li class="relative flex items-center">
                <span
                    class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                </span>
                <a href="{{ route('menus.create') }}"
                    class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['menus.create']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                    Tambah Menu
                </a>
            </li>
        </ol>
    </nav>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="UserEmail"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="UserEmail" placeholder="Email" name="nama_menu"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required />
                <span
                    class="absolute start-3 top-3 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs">
                    Masukkan Nama Menu
                </span>
            </label>
        </div>
        <div class="mb-4">
            <div>
                <label for="HeadlineAct" class="block text-sm font-medium text-gray-900"> Jenis Menu </label>
                <div class="relative mt-1.5">
                    <input type="text" list="HeadlineActArtist" id="HeadlineAct" name="jenis_menu"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm [&::-webkit-calendar-picker-indicator]:opacity-0"
                        placeholder="Masukkan Jenis Menu" required />
                    <span class="absolute inset-y-0 end-0 flex w-8 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </span>
                </div>
                <datalist name="jenis_menu" id="HeadlineActArtist">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </datalist>
            </div>
        </div>
        <div class="mb-4">
            <div>
                <label for="harga_menu" class="block text-sm font-medium text-gray-900">Harga Menu</label>
                <div class="relative mt-1.5">
                    <select id="harga_menu" name="harga_menu"
                        class="w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm p-2 h-10" required>
                        @for ($i = 1000; $i <= 20000; $i +=1000) <option value="{{ $i }}" {{ isset($menu) && $menu->
                            harga_menu == $i ? 'selected' : '' }}>
                            Rp {{ number_format($i, 0, ',', '.') }}
                            </option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="catatan_menu"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="catatan_menu" placeholder="Masukkan Catatan Menu" name="catatan_menu"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required />
                <span
                    class="absolute start-3 top-3 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs">
                    Masukkan Catatan (Opsional)
                </span>
            </label>
        </div>
        <button type="submit"
            class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring" href="#">
            <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
            <span
                class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                Tambah Menu
            </span>
        </button>
    </form>
</div>
@endsection