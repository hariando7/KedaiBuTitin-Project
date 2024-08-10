<?php

namespace App\Http\Controllers;

use App\Models\PrasmananOrder;
use App\Models\PrasmananStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrasmananOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = PrasmananOrder::query();
        
        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_pesanan', [$startDate, $endDate]);
        }
    
        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(items) LIKE ?', ['%' . $search . '%']);
            });
        }
    
        $orders = $query->paginate(30); // Menggunakan paginate dengan 30 item per halaman
    
        return view('prasmanan_orders.index', compact('orders'));
    }    

    public function create()
    {
        $stocks = PrasmananStock::all();
        return view('prasmanan_orders.create', compact('stocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'tanggal_pesanan' => 'required|date_format:Y-m-d\TH:i',
        ]);
    
        $items = $request->input('items');
        $totalHarga = 0;
    
        foreach ($items as $item) {
            $stock = PrasmananStock::find($item['id']);
            if (!$stock || $stock->stok_menu < $item['quantity']) {
                return redirect()->back()->withErrors(['Stock for menu ' . $item['nama_menu'] . ' is insufficient or not found']);
            }
        }
    
        foreach ($items as $item) {
            $stock = PrasmananStock::find($item['id']);
            $stock->stok_menu -= $item['quantity'];
            $stock->save();
        }
    
        foreach ($items as $item) {
            $totalHarga += $item['harga_menu'] * $item['quantity'];
        }
    
        PrasmananOrder::create([
            'items' => json_encode($items),
            'tanggal_pesanan' => $request->input('tanggal_pesanan'),
        ]);
    
        return redirect()->route('prasmanan_orders.index');
    }
    

    public function edit(PrasmananOrder $prasmananOrder)
    {
        $stocks = PrasmananStock::all();
        return view('prasmanan_orders.edit', compact('prasmananOrder', 'stocks'));
    }

    public function update(Request $request, PrasmananOrder $prasmananOrder)
    {
        $request->validate([
            'items' => 'required|array',
            'tanggal_pesanan' => 'required|date',
        ]);

        foreach (json_decode($prasmananOrder->items) as $item) {
            $stock = PrasmananStock::find($item->id);
            $stock->stok_menu += $item->quantity;
            $stock->save();
        }

        $items = $request->input('items');
        $totalHarga = 0;

        foreach ($items as $item) {
            $stock = PrasmananStock::find($item['id']);
            if (!$stock || $stock->stok_menu < $item['quantity']) {
                return redirect()->back()->withErrors(['Stock for menu ' . $item['nama_menu'] . ' is insufficient or not found']);
            }
        }

        foreach ($items as $item) {
            $stock = PrasmananStock::find($item['id']);
            $stock->stok_menu -= $item['quantity'];
            $stock->save();
        }

        foreach ($items as $item) {
            $totalHarga += $item['harga_menu'] * $item['quantity'];
        }

        $prasmananOrder->update([
            'items' => json_encode($items),
            'tanggal_pesanan' => $request->input('tanggal_pesanan'),
        ]);

        return redirect()->route('prasmanan_orders.index');
    }

    public function destroy(PrasmananOrder $prasmananOrder)
    {
        // Restore stock quantities
        foreach (json_decode($prasmananOrder->items) as $item) {
            $stock = PrasmananStock::find($item->id);
            $stock->stok_menu += $item->quantity;
            $stock->save();
        }

        $prasmananOrder->delete();
        return redirect()->route('prasmanan_orders.index');
    }

    public function report(Request $request)
    {
        $query = PrasmananOrder::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_pesanan', [$request->start_date, $request->end_date]);
        }

        $orders = $query->get();
        $totalRevenue = $orders->sum('total_harga');
        $totalOrders = $orders->count();

        return view('prasmanan_orders.report', compact('orders', 'totalRevenue', 'totalOrders'));
    }

    public function show($id)
    {
        $order = PrasmananOrder::findOrFail($id);

        $items = json_decode($order->items);
        $totalHarga = 0;

        foreach ($items as $item) {
            $totalHarga += $item->quantity * $item->harga_menu;
        }

        $order->total_harga = $totalHarga;

        return view('prasmanan_orders.show', compact('order'));
    }
}
