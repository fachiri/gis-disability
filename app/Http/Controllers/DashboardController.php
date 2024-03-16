<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Penyandang;
use App\Models\Relawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $relawan = Relawan::all();
        $penyandang = Penyandang::all();
        $districts = District::all();

        return view('pages.dashboard.index', compact('districts', 'relawan', 'penyandang'));
    }
}
