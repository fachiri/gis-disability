<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;
use App\Models\Bantuan;
use App\Models\Penyandang;

class BantuanController extends Controller
{
    public function index()
    {
        $bantuan = Bantuan::with('penyandang')->get();

        return view('pages.dashboard.bantuan.index', compact('bantuan'));
    }

    public function create()
    {
        $penyandang = Penyandang::all();

        return view('pages.dashboard.bantuan.create', compact('penyandang'));
    }

    public function store(StoreBantuanRequest $request)
    {
        try {
            Bantuan::create($request->all());

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Bantuan $bantuan)
    {
        //
    }

    public function edit(Bantuan $bantuan)
    {
        //
    }

    public function update(UpdateBantuanRequest $request, Bantuan $bantuan)
    {
        //
    }

    public function destroy(Bantuan $bantuan)
    {
        //
    }
}
