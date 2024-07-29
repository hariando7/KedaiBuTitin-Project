<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralPageController extends Controller
{
    // Awal Dashboard
    function dashboard()
    {
        return view('dashboard/welcome');
    }
    // Akhir Dashboard
}
