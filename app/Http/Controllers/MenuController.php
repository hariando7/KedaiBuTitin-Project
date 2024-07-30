<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
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
            'harga_menu' => 'required|integer|min:1',
            'catatan_menu' => 'required|string|max:255',
        ]);

        Menu::create($request->only(['nama_menu', 'jenis_menu', 'harga_menu', 'catatan_menu']));
        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
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
            'harga_menu' => 'required|integer|min:1',
            'catatan_menu' => 'required|string|max:255',
        ]);

        $menu->update($request->only(['nama_menu', 'jenis_menu', 'harga_menu', 'catatan_menu']));
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
