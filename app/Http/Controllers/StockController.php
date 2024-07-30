<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Mengambil semua stok dengan menu terkait
        $stocks = Stock::with('menu')->get();

        // Menghitung jumlah pesanan untuk setiap stok
        $stocks->map(function ($stock) {
            $stock->jumlah_pesanan = Order::where('menu_id', $stock->menu_id)->sum('jumlah_pesanan');
            return $stock;
        });

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('stocks.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah_stok' => 'required|integer|min:0',
        ]);
    
        // Cek apakah stok untuk menu ini sudah ada
        $existingStock = Stock::where('menu_id', $request->input('menu_id'))->first();
    
        if ($existingStock) {
            return redirect()->back()->with('error', 'Stock Sudah Tersedia, Tidak Bisa Menambahkan Data Yang Sama');
        }
    
        // Jika stok belum ada, buat stok baru
        Stock::create($request->only(['menu_id', 'jumlah_stok']));
        return redirect()->route('stocks.index')->with('success', 'Stock Berhasil Dibuat');
    }

    public function edit(Stock $stock)
    {
        $menus = Menu::all();
        return view('stocks.edit', compact('stock', 'menus'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        $stock->update($request->only(['menu_id', 'jumlah_stok']));
        return redirect()->route('stocks.index')->with('success', 'Stock Berhasil Di Update');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock Berhasil Di Hapus');
    }

    public function reset()
    {
        // Mengatur ulang stok untuk semua menu menjadi 100
        Stock::query()->update(['jumlah_stok' => 100]);

        return redirect()->route('stocks.index')->with('success', 'All stock quantities have been reset to 100.');
    }
}
