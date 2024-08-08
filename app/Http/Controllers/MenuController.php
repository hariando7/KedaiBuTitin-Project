<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('nama_menu', 'asc')->get();
        return view('menus.index', compact('menus'));
    }
    
    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'jenis_menu' => 'required|string|max:255',
            'catatan_menu' => 'required|string|max:255',
        ]);

        $existingMenu = Menu::where('nama_menu', $request->nama_menu)->first();

        if ($existingMenu) {
            return redirect()->back()->with('error', 'Menu Sudah Ditambahkan');
        }

        Menu::create($request->only(['nama_menu', 'jenis_menu', 'catatan_menu']));
        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Ditambhkan');
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'jenis_menu' => 'required|string|max:255',
            'catatan_menu' => 'required|string|max:255',
        ]);

        $menu->update($request->only(['nama_menu', 'jenis_menu', 'catatan_menu']));
        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Di Update');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu Berhasil Di Hapus');
    }
}
