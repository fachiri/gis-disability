<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRelawanRequest;
use App\Http\Requests\UpdateRelawanRequest;
use App\Models\Relawan;
use App\Models\User;

class RelawanController extends Controller
{
    public function index()
    {
        $relawan = Relawan::all();

        return view('pages.dashboard.master.relawan.index', compact('relawan'));
    }

    public function create()
    {
        return view('pages.dashboard.master.relawan.create');
    }

    public function store(StoreRelawanRequest $request)
    {
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => explode("@", $request->email)[0]
            ]);

            Relawan::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'kontak' => $request->kontak
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Relawan $relawan)
    {
        return view('pages.dashboard.master.relawan.show', compact('relawan'));
    }

    public function edit(Relawan $relawan)
    {
        return view('pages.dashboard.master.relawan.edit', compact('relawan'));
    }

    public function update(UpdateRelawanRequest $request, Relawan $relawan)
    {
        try {
            $relawan->nama = $request->nama;
            $relawan->kontak = $request->kontak;
            $relawan->save();

            $relawan->user->email = $request->email;
            $relawan->user->save();

            return redirect()->back()->with('success', 'Data berhasil diedit.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Relawan $relawan)
    {
        try {
            $relawan->delete();

            return redirect()->route('master.relawan.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
