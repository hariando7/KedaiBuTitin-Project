@extends('layouts.app')

@section('content')
<div class="bg-white">
    <a href="{{ route('stocks.index') }}"
        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring mb-10" href="#">
        <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
        <span
            class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
            Kembali
        </span>
    </a>
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex mb-5">
            <ol class="flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <a href="{{ route('stocks.index') }}"
                        class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ms-1.5 text-xs font-medium">Stok</span>
                    </a>
                </li>
                <li class="relative flex items-center">
                    <span
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180">
                    </span>
                    <a href="{{ route('stocks.create') }}"
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['stocks.create']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        Tambah Stok
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Tambah Stok</h1>
    @if(session('error'))
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="menu_id" class="block text-sm font-medium text-gray-900">Menu</label>
            <select name="menu_id" id="menu_id" class="w-full rounded-lg border-gray-300 px-4 py-2 border">
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <div>
                <div class="relative mt-1.5">
                    <label for="HeadlineAct" class="block text-sm font-medium text-gray-900"> Jumlah Stok </label>
                    <input type="number" name="jumlah_stok" id="jumlah_stok" list="HeadlineActArtist"
                        class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm [&::-webkit-calendar-picker-indicator]:opacity-0"
                        placeholder="Masukkan Jumlah Stok" required />
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-10">
            <button type="submit"
                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring"
                href="#">
                <span class="absolute inset-0 border border-orange-600 group-active:border-orange-500"></span>
                <span
                    class="block border border-orange-600 bg-orange-600 px-12 py-3 transition-transform active:border-orange-500 active:bg-orange-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                    Tambah Stok
                </span>
            </button>
        </div>
    </form>
</div>
@endsection