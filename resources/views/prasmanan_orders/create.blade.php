@extends('layouts.app')

@section('content')
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        height: 38px;
        line-height: 38px;
    }
</style>
<div class="bg-white">
    @if($errors->any())
    <script>
        window.onload = function() {
            alert('{{ $errors->first() }}');
        };
    </script>
    @endif

    @if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session('success') }}');
        };
    </script>
    @endif


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
                        <span class="ms-1.5 text-xs font-medium">Daftar Pesanan</span>
                    </div>
                </li>
                <li class="relative flex items-center">
                    <span
                        class="absolute inset-y-0 -start-px h-10 w-4 bg-gray-100 [clip-path:_polygon(0_0,_0%_100%,_100%_50%)] rtl:rotate-180"></span>
                    <div
                        class="flex h-10 items-center bg-white pe-4 ps-8 text-xs font-medium {{ Request::routeIs(['prasmanan_orders.create']) ? 'bg-gray-100 dark:bg-orange-400 text-gray-600 dark:text-white' : '' }}">
                        Tambah Pesanan
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('prasmanan_orders.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.create']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kelola
                Pesanan</a>
            <a href="{{ route('prasmanan_stocks.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.create']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kelola
                Stok Menu</a>
        </div>
    </div>

    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Tambah Pesanan</h1>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Kasir Tambah Pesanan</h2>
        <form action="{{ route('prasmanan_orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tanggal_pesanan" class="block text-gray-700">Tanggal Pesanan</label>
                <input type="datetime-local" id="tanggal_pesanan" name="tanggal_pesanan" required
                    class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const inputTanggal = document.getElementById('tanggal_pesanan');
                    const sekarang = new Date();
                    const tahun = sekarang.getFullYear();
                    const bulan = String(sekarang.getMonth() + 1).padStart(2, '0');
                    const hari = String(sekarang.getDate()).padStart(2, '0');
                    const jam = String(sekarang.getHours()).padStart(2, '0');
                    const menit = String(sekarang.getMinutes()).padStart(2, '0');
                    const formatTanggal = `${tahun}-${bulan}-${hari}T${jam}:${menit}`;
                    inputTanggal.value = formatTanggal;
                });
            </script>

            <div id="items">
                <div class="mb-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                    <label for="item_name_0" class="block text-gray-700">Nama Menu</label>
                    <select id="item_name_0" name="items[0][id]" required
                        class="h-12 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm"
                        onchange="updateItemDetails(0)">
                        <option value="">Pilih Menu</option>
                        @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}" data-nama-menu="{{ $stock->nama_menu }}">{{ $stock->nama_menu
                            }}</option>
                        @endforeach
                    </select>
                    <script>
                        $(document).ready(function() {
                        $('#item_name_0').select2({
                            placeholder: "Pilih Menu",
                            allowClear: true,
                        });
                    });
                    </script>
                    <label for="quantity_0" class="block text-gray-700 mt-2">Jumlah Menu</label>
                    <div class="flex items-center">
                        <button type="button" onclick="decrementQuantity(0)"
                            class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-l-lg">-</button>
                        <input type="number" name="items[0][quantity]" id="quantity_0" value="1" min="1" required
                            class="h-10 w-full border-t border-b border-gray-300 bg-transparent p-2 text-center sm:text-sm">
                        <button type="button" onclick="incrementQuantity(0)"
                            class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-r-lg">+</button>
                    </div>

                    <label for="harga_menu_0" class="block text-gray-700 mt-2">Harga Menu</label>
                    <div class="relative">
                        <input type="text" name="items[0][harga_menu]" id="harga_menu_0"
                            class="w-full px-4 py-2 border rounded-lg border-gray-300 pl-12" placeholder="10.000" />
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp.</span>
                    </div>
                    <input type="hidden" name="items[0][nama_menu]" id="nama_menu_0" value="">
                </div>
            </div>
            <div class="m-auto justify-center flex gap-5">
                <button type="button" onclick="addItem()"
                    class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.create']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Tambah
                    Item</button>
                <button type="submit"
                    class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.create']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1;
    
        function addItem() {
            const container = document.getElementById('items');
            const newItem = document.createElement('div');
            newItem.className = 'mb-4 bg-gray-50 p-4 rounded-lg shadow-inner';
            newItem.innerHTML = `
                <label for="item_name_${itemIndex}" class="block text-gray-700">Nama Menu</label>
                <select id="item_name_${itemIndex}" name="items[${itemIndex}][id]" required class="h-12 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm" onchange="updateItemDetails(${itemIndex})">
                    <option value="">Pilih Menu</option>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}" data-nama-menu="{{ $stock->nama_menu }}" data-harga-menu="{{ $stock->harga_menu }}">{{ $stock->nama_menu }}</option>
                    @endforeach
                </select>
    
                <label for="quantity_${itemIndex}" class="block text-gray-700 mt-2">Jumlah Menu</label>
                <div class="flex items-center">
                    <button type="button" onclick="decrementQuantity(${itemIndex})" class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-l-lg">-</button>
                    <input type="number" name="items[${itemIndex}][quantity]" id="quantity_${itemIndex}" value="1" min="1" required class="h-10 w-full border-t border-b border-gray-300 bg-transparent p-2 text-center sm:text-sm">
                    <button type="button" onclick="incrementQuantity(${itemIndex})" class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-r-lg">+</button>
                </div>
    
                <label for="harga_menu_${itemIndex}" class="block text-gray-700 mt-2">Harga Menu</label>
                <div class="relative">
                        <input type="text" name="items[${itemIndex}][harga_menu]" id="harga_menu_${itemIndex}"
                            class="w-full px-4 py-2 border rounded-lg border-gray-300 pl-12" placeholder="10.000" />
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp.</span>
                </div>
                <input type="hidden" name="items[${itemIndex}][nama_menu]" id="nama_menu_${itemIndex}" value="">
            `;
            container.appendChild(newItem);
            $('#item_name_' + itemIndex).select2({
            placeholder: "Pilih Menu",
            allowClear: true,
            });
            itemIndex++;
        }
    
        function updateItemDetails(index) {
            const selectElement = document.getElementById(`item_name_${index}`);
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const namaMenu = selectedOption.getAttribute('data-nama-menu');
            let hargaMenu;
    
            switch (namaMenu) {
                case 'Prasmanan':
                    hargaMenu = 12000;
                    break;
                case 'Ayam Geprek':
                    hargaMenu = 10000;
                    break;
                case 'Mie Goreng':
                    hargaMenu = 13000;
                    break;
                default:
                    hargaMenu = 0;
                    break;
            }
    
            document.getElementById(`nama_menu_${index}`).value = namaMenu;
            document.getElementById(`harga_menu_${index}`).value = hargaMenu;
        }
    
        function incrementQuantity(index) {
            const quantityInput = document.getElementById('quantity_' + index);
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    
        function decrementQuantity(index) {
            const quantityInput = document.getElementById('quantity_' + index);
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>
</div>
@endsection