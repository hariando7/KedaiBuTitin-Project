<!-- resources/views/menus/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="">
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="mb-5 flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div
                        class="flex h-10 items-center gap-1.5 bg-gray-100 px-4 transition hover:text-gray-900 {{ Request::routeIs(['menus.index']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-90">
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
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium transition hover:text-gray-900 0">
                        Tambah Menu
                    </div>
                </li>
            </ol>
        </nav>
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

    <div class="flex justify-between">
        <h1 class="text-4xl text-black dark:text-orange-900">Menu Kedai Ibu Titin</h1>
        <a href="{{ route('menus.create') }}"
            class="btn border-none dark:bg-orange-700 text-black dark:text-white">Tambah
            Menu</a>
    </div>
    @if(session('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
    @endif
    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Jenis Menu</th>
                    {{-- <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Harga Menu</th>
                    --}}
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Catatan Menu</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Tanggal Ditambahkan
                    </th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $index => $menu)
                <tr>
                    <th class="border px-4 py-2">{{ $index + 1 }}</th>
                    <td class="border px-4 py-2">{{ $menu->nama_menu }}</td>
                    <td class="border px-4 py-2">{{ $menu->jenis_menu }}</td>
                    {{-- <td class="border px-4 py-2">Rp. {{ number_format($menu->harga_menu, 0, ',', '.') }}</td> --}}
                    <td class="border px-4 py-2">{{ $menu->catatan_menu }}</td>
                    <td class="border px-4 py-2">{{ $menu->created_at }}</td>
                    <td class="border px-4 py-2">
                        <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
                            <a href="{{ route('menus.edit', $menu->id) }}"
                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Edit Product">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                    title="Delete Product">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </span>
                    </td>
                    <th class="border px-4 py-2" style="display:none;">{{ $menu->id }}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">No</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Nama Menu</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Jenis Menu</th>
                    {{-- <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Harga Menu</th>
                    --}}
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Catatan Menu</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Tanggal Ditambahkan
                    </th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400">Aksi</th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection