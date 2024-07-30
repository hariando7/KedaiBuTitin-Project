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
        
        $query->orderBy('created_at', 'desc');
    
        // Pagination
        $orders = $query->paginate(10); 
    
        return view('orders.index', compact('orders'));
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
            'catatan_pesanan' => 'required|string|max:255',
        ]);

        $menu = Menu::find($request->menu_id);
        $stock = $menu->stock;

        if ($stock && $stock->jumlah_stok >= $request->jumlah_pesanan) {
            // Create order
            Order::create([
                'menu_id' => $request->menu_id,
                'jumlah_pesanan' => $request->jumlah_pesanan,
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
        
        $orders = $query->get(); // ambil semua hasil tanpa pagination
    
        $totalQuantity = $orders->sum('jumlah_pesanan');
        $totalRevenue = $orders->sum(function($order) {
            return $order->jumlah_pesanan * $order->menu->harga_menu;
        });
    
        // Terapkan pagination pada hasil yang telah dihitung
        $orders = $query->paginate(10); 
    
        return view('orders.report', compact('orders', 'totalQuantity', 'totalRevenue'));
    }
    
    
    

    public function export(Request $request)
    {
        return Excel::download(new OrdersExport($request->input('start_date'), $request->input('end_date'), $request->input('search')), 'orders.xlsx');
    }

}
