<!-- resources/views/menus/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white=">
    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Edit Menu</h1>
    <nav aria-label="Breadcrumb" class="flex">
        <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
            <li class="flex items-center">
                <a href="#" class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900">
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
                    class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900">
                    Tambah Menu
                </a>
            </li>
            <li class="relative flex items-center">
                <span
                    class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                </span>
                <a href="#"
                    class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['menus.edit']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                    Edit Menu
                </a>
            </li>
        </ol>
    </nav>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="UserEmail"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="UserEmail" placeholder="Masukkan Nama Menu" name="nama_menu"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required value="{{ $menu->nama_menu }}" />
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
                        placeholder="Please select" required />
                    <span class="absolute inset-y-0 end-0 flex w-8 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </span>
                </div>
                <datalist name="jenis_menu" id="HeadlineActArtist">
                    <option value=" Makanan" {{ $menu->jenis_menu == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="Minuman" {{ $menu->jenis_menu == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </datalist>
            </div>
        </div>
        <div class="mb-4">
            <div>
                <label for="harga_menu" class="block text-sm font-medium text-gray-900">Harga Menu</label>
                <div class="relative mt-1.5">
                    <input type="number" list="harga_list" id="harga_menu" name="harga_menu"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm [&::-webkit-calendar-picker-indicator]:opacity-0"
                        placeholder="Masukkan Harga Menu" required />
                    <span class="absolute inset-y-0 end-0 flex w-8 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </span>
                </div>
                <datalist id="harga_list">
                    <option value="1000" {{ $menu->harga_menu == '1000' ? 'selected' : '' }}>1000</option>
                    <option value="2000" {{ $menu->harga_menu == '2000' ? 'selected' : '' }}>2000</option>
                    <option value="3000" {{ $menu->harga_menu == '3000' ? 'selected' : '' }}>3000</option>
                    <option value="4000" {{ $menu->harga_menu == '4000' ? 'selected' : '' }}>4000</option>
                    <option value="5000" {{ $menu->harga_menu == '5000' ? 'selected' : '' }}>5000</option>
                    <option value="6000" {{ $menu->harga_menu == '6000' ? 'selected' : '' }}>6000</option>
                    <option value="7000" {{ $menu->harga_menu == '7000' ? 'selected' : '' }}>7000</option>
                    <option value="8000" {{ $menu->harga_menu == '8000' ? 'selected' : '' }}>8000</option>
                    <option value="9000" {{ $menu->harga_menu == '9000' ? 'selected' : '' }}>9000</option>
                    <option value="10000" {{ $menu->harga_menu == '10000' ? 'selected' : '' }}>10000</option>
                    <option value="11000" {{ $menu->harga_menu == '11000' ? 'selected' : '' }}>11000</option>
                    <option value="12000" {{ $menu->harga_menu == '12000' ? 'selected' : '' }}>12000</option>
                    <option value="13000" {{ $menu->harga_menu == '13000' ? 'selected' : '' }}>13000</option>
                    <option value="14000" {{ $menu->harga_menu == '14000' ? 'selected' : '' }}>14000</option>
                    <option value="15000" {{ $menu->harga_menu == '15000' ? 'selected' : '' }}>15000</option>
                </datalist>
            </div>
        </div>
        <div class="mb-4">
            <label for="catatan_menu"
                class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">
                <input type="text" id="catatan_menu" placeholder="Masukkan Catatan Menu" name="catatan_menu"
                    class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                    required value="{{ $menu->catatan_menu }}" />
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
                Edit
            </span>
        </button>
    </form>
</div>
@endsection