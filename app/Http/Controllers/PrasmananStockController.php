<?php

namespace App\Http\Controllers;

use App\Models\PrasmananStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PrasmananStockController extends Controller
{
    public function index()
    {
        $stocks = PrasmananStock::all();
        return view('prasmanan_stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('prasmanan_stocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'stok_menu' => 'required|integer|min:0',
            'tanggal_ditambahkan' => 'required|date',
        ]);
    
        // Check if the menu already exists
        $existingStock = PrasmananStock::where('nama_menu', $request->nama_menu)->first();
    
        if ($existingStock) {
            // Set flash message for duplicate entry
            session()->flash('error', 'Data dengan nama menu tersebut sudah ada.');
    
            return redirect()->back()->withInput();
        }
    
        PrasmananStock::create($request->all());
    
        // Set flash message for successful addition
        session()->flash('success', 'Data berhasil ditambahkan.');
    
        return redirect()->route('prasmanan_stocks.index');
    }

    public function edit(PrasmananStock $prasmananStock)
    {
        return view('prasmanan_stocks.edit', compact('prasmananStock'));
    }

    public function update(Request $request, PrasmananStock $prasmananStock)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'stok_menu' => 'required|integer|min:0',
            'tanggal_ditambahkan' => 'required|date',
        ]);

        // Log debugging information
        Log::info('Updating PrasmananStock:', ['id' => $prasmananStock->id, 'request' => $request->all()]);

        $prasmananStock->update($request->all());
        return redirect()->route('prasmanan_stocks.index');
    }
    

    public function destroy(PrasmananStock $prasmananStock)
    {
        $prasmananStock->delete();
    
        // Set flash message
        session()->flash('success', 'Data berhasil dihapus.');
    
        return redirect()->route('prasmanan_stocks.index');
    }    
}
