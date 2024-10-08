@extends('layouts.app')

@section('content')
<div class="bg-white">
    <script>
        window.onload = function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
            @elseif (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        };
    </script>
    <div class="flex justify-between">
        <nav aria-label="Breadcrumb" class="flex">
            <ol class="flex overflow-hidden rounded-lg border border-gray-200 text-gray-600">
                <li class="flex items-center">
                    <div
                        class="flex h-12 items-center gap-1.5 bg-white px-4 transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_stocks.index']) ? 'bg-gray-100 dark:bg-orange-400 text-gray-600 dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ms-1.5 text-xs font-medium">Stok</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('prasmanan_orders.index') }}"
                class="btn border-none bg-gray-700 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_stocks.index']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-white px-4 transition hover:text-gray-900">Kelola
                Pesanan</a>
        </div>
    </div>
    <div class="flex justify-between mt-5">
        <h1 class="text-4xl text-black dark:text-orange-900">Stok Kedai Ibu Titin</h1>
        <a href="{{ route('prasmanan_stocks.create') }}"
            class="btn border-none bg-gray-700 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_stocks.index']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-white px-4 transition hover:text-gray-900">Tambah
            Stok</a>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table table-xs table-pin-rows table-pin-cols border">
            <thead>
                <tr>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">No
                    </th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Nama
                        Menu</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Stok
                        Menu</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">
                        Tanggal Ditambahkan</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Aksi
                    </th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $index => $stock)
                <tr>
                    <th class="border px-4 py-2 text-black dark:text-orange-900">{{ $index + 1 }}</th>
                    <td class="border px-4 py-2 text-black dark:text-orange-900">{{ $stock->nama_menu }}</td>
                    <td
                        class="border px-4 py-2 text-black dark:text-orange-900 {{ $stock->stok_menu == 0 ? 'bg-red-500 text-white' : '' }}">
                        {{$stock->stok_menu}}
                    </td>
                    <td class="border px-4 py-2 text-black dark:text-orange-900text-black dark:text-orange-900">
                        {{ \Carbon\Carbon::parse($stock->tanggal_ditambahkan)->format('Y-m-d H:i') }}
                    </td>
                    <td class="border px-4 py-2 text-black dark:text-orange-900">
                        <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
                            <a href="{{ route('prasmanan_stocks.edit', $stock->id) }}"
                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Edit Product">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            {{-- <form action="{{ route('prasmanan_stocks.destroy', $stock->id) }}" method="POST">
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
                            </form> --}}
                        </span>
                    </td>
                    <td class="font-bold border px-4 py-2 text-black dark:text-orange-900" style="display:none;">{{
                        $index + 1 }}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">No
                    </th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Nama
                        Menu</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Stok
                        Menu</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">
                        Tanggal Ditambahkan</th>
                    <th class="text-black dark:text-white font-bold border px-4 py-2 bg-white dark:bg-orange-400">Aksi
                    </th>
                    <th class="text-black dark:text-white px-4 py-2 bg-white dark:bg-orange-400" style="display:none;">
                        ID</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection