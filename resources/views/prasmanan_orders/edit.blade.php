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
                        class="flex h-10 items-center pe-4 ps-8 text-xs font-medium {{ Request::routeIs(['prasmanan_orders.edit']) ? 'bg-gray-100 dark:bg-orange-700 text-gray-600 dark:text-white' : '' }}">
                        Edit Pesanan
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex gap-5">
            <a href="{{ route('prasmanan_orders.index') }}"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.edit']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Kembali</a>
        </div>
    </div>

    <h1 class="text-4xl mb-5 text-black dark:text-orange-900">Edit Pesanan</h1>

    <form action="{{ route('prasmanan_orders.update', $prasmananOrder->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="tanggal_pesanan" class="block text-gray-700">Tanggal Pesanan</label>
            <input type="datetime-local" id="tanggal_pesanan" name="tanggal_pesanan"
                value="{{ $prasmananOrder->tanggal_pesanan }}"
                class="h-10 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm">
        </div>

        <div id="items">
            @foreach(json_decode($prasmananOrder->items) as $index => $item)
            <div class="mb-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                <label for="item_name_{{ $index }}" class="block text-gray-700">Nama Menu</label>
                <select id="item_name_{{ $index }}" name="items[{{ $index }}][id]" required
                    class="h-12 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm"
                    onchange="updateItemDetails({{ $index }})">
                    @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}" {{ $stock->id == $item->id ? 'selected' : '' }}
                        data-nama-menu="{{ $stock->nama_menu }}" data-harga-menu="{{ $stock->harga_menu }}">
                        {{ $stock->nama_menu }}
                    </option>
                    @endforeach
                </select>

                <label for="quantity_{{ $index }}" class="block text-gray-700 mt-2">Jumlah Menu</label>
                <div class="flex items-center">
                    <button type="button" onclick="decrementQuantity({{ $index }})"
                        class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-l-lg">-</button>
                    <input type="number" name="items[{{ $index }}][quantity]" id="quantity_{{ $index }}"
                        value="{{ $item->quantity }}" min="1" required
                        class="h-10 w-full border-t border-b border-gray-300 bg-transparent p-2 text-center sm:text-sm">
                    <button type="button" onclick="incrementQuantity({{ $index }})"
                        class="h-10 w-10 border border-gray-300 bg-transparent text-gray-600 rounded-r-lg">+</button>
                </div>

                <label for="harga_menu_{{ $index }}" class="block text-gray-700 mt-2">Harga Menu</label>
                <div class="relative">
                    <input type="text" name="items[{{ $index }}][harga_menu]" id="harga_menu_{{ $index }}"
                        class="w-full px-4 py-2 border rounded-lg border-gray-300 pl-12" placeholder="10.000" />
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp.</span>
                </div>
                <input type="hidden" name="items[{{ $index }}][nama_menu]" id="nama_menu_{{ $index }}"
                    value="{{ $item->nama_menu }}">
            </div>
            @endforeach
        </div>

        <div class="m-auto justify-center flex gap-5">
            <button type="button" onclick="addItem()"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.edit']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Tambah
                Item</button>
            <button type="submit"
                class="btn border-none bg-gray-100 text-xs font-medium transition hover:text-gray-900 {{ Request::routeIs(['prasmanan_orders.edit']) ? 'bg-gray-700 dark:bg-orange-700 text-white dark:text-white dark:hover:text-white ' : '' }} text-gray-600 px-4 transition hover:text-gray-900">Simpan</button>
        </div>
    </form>

    <script>
        let itemIndex = {{ count(json_decode($prasmananOrder->items)) }};
    
        function addItem() {
            const container = document.getElementById('items');
            const newItem = document.createElement('div');
            newItem.className = 'mb-4 bg-gray-50 p-4 rounded-lg shadow-inner';
            newItem.innerHTML = `
                <label for="item_name_${itemIndex}" class="block text-gray-700">Nama Menu</label>
                <select id="item_name_${itemIndex}" name="items[${itemIndex}][id]" required class="h-12 w-full border rounded-lg border-gray-300 bg-transparent p-2 sm:text-sm" onchange="updateItemDetails(${itemIndex})">
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
                    <input type="text" name="items[${itemIndex}][harga_menu]" id="harga_menu_${itemIndex}" class="w-full px-4 py-2 border rounded-lg border-gray-300 pl-12" placeholder="10.000">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp.</span>
                </div>
                <input type="hidden" name="items[${itemIndex}][nama_menu]" id="nama_menu_${itemIndex}" value="">
            `;
            container.appendChild(newItem);
            itemIndex++;
        }
    
        function updateItemDetails(index) {
            const selectElement = document.getElementById(`item_name_${index}`);
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const namaMenu = selectedOption.getAttribute('data-nama-menu');
            const hargaMenu = selectedOption.getAttribute('data-harga-menu');
            
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