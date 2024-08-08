<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('menu');
        
        // Filter berdasarkan rentang tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $endDate = $endDate . ' 23:59:59';
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        // Pencarian berdasarkan nama menu
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->whereHas('menu', function($q) use ($search) {
                $q->where('nama_menu', 'like', "%{$search}%");
            });
        }
    
        // Filter berdasarkan menu_id
        if ($request->has('menu_id') && $request->input('menu_id') !== '') {
            $menuId = $request->input('menu_id');
            $query->where('menu_id', $menuId);
        }
        
        $query->orderBy('created_at', 'desc');
    
        // Pagination
        $orders = $query->paginate(10); 
        
        $menus = Menu::all(); 
    
        return view('orders.index', compact('orders', 'menus'));
    }    

    public function create()
    {
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah_pesanan' => 'required|integer|min:1',
            'harga_pesanan' => 'required|integer|min:1',
            'catatan_pesanan' => 'required|string|max:255',
        ]);

        $menu = Menu::find($request->menu_id);
        $stock = $menu->stock;

        if ($stock && $stock->jumlah_stok >= $request->jumlah_pesanan) {
            // Create order
            Order::create([
                'menu_id' => $request->menu_id,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'harga_pesanan' => $request->harga_pesanan,
                'catatan_pesanan' => $request->catatan_pesanan,
            ]);

            // Update stock
            $stock->decrement('jumlah_stok', $request->jumlah_pesanan);

            return redirect()->route('orders.index')->with('success', 'Pesanan Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Stok Habis!!!');
        }
    }

    public function destroy(Order $order)
    {
        $stock = Stock::where('menu_id', $order->menu_id)->first();
        if ($stock) {
            $stock->increment('jumlah_stok', $order->jumlah_pesanan);
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan Berhasil Dihapus');
    }

    public function report(Request $request)
    {
        $query = Order::with('menu');
        
        // Filter berdasarkan rentang tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $endDate = $endDate . ' 23:59:59';
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        // Pencarian berdasarkan nama menu
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->whereHas('menu', function($q) use ($search) {
                $q->where('nama_menu', 'like', "%{$search}%");
            });
        }
        
        $query->orderBy('created_at', 'desc');
        
        // Ambil semua hasil tanpa pagination untuk perhitungan
        $orders = $query->get();
        
        // Hitung total jumlah pesanan
        $totalQuantity = $orders->sum('jumlah_pesanan');
    
        // Hitung total pendapatan
        $totalRevenue = $orders->sum(function($order) {
            return $order->jumlah_pesanan * $order->harga_pesanan;
        });
        
        $orders = $query->paginate(10);
    
        return view('orders.report', compact('orders', 'totalQuantity', 'totalRevenue'));
    }
    
    
    public function export(Request $request)
    {
        return Excel::download(new OrdersExport($request->input('start_date'), $request->input('end_date'), $request->input('search')), 'orders.xlsx');
    }

}
