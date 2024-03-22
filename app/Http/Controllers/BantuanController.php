<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiveBantuanRequest;
use App\Http\Requests\StoreBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;
use App\Models\Bantuan;
use App\Models\Penyandang;
use Illuminate\Support\Facades\Storage;

class BantuanController extends Controller
{
    public function index()
    {
        $query = Bantuan::query();

        if (auth()->user()->isRelawan()) {
            $districtId = auth()->user()->relawan->district->id;
            $query->whereHas('penyandang', function ($query) use ($districtId) {
                $query->where('district_id', $districtId);
            });
        }

        $bantuan = $query->with('penyandang')->get();

        return view('pages.dashboard.bantuan.index', compact('bantuan'));
    }

    public function create()
    {
        if (!auth()->user()->isRelawan()) {
            return redirect()->back()->withErrors('Akses tidak sah.');
        }

        $query = Penyandang::query();
        $query->where('relawan_id', auth()->user()->relawan->id);

        $penyandang = $query->get();

        return view('pages.dashboard.bantuan.create', compact('penyandang'));
    }

    public function store(StoreBantuanRequest $request)
    {
        try {
            $bantuan = Bantuan::create(
                $request->only([
                    'penyandang_id', 'jenis', 'detail'
                ]) + [
                    'relawan_id' => auth()->user()->relawan?->id
                ]
            );

            return redirect()->route('dashboard.bantuan.show', $bantuan->uuid)->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Bantuan $bantuan)
    {
        return view('pages.dashboard.bantuan.show', compact('bantuan'));
    }

    public function edit(Bantuan $bantuan)
    {
        $this->authorize('edit', $bantuan);

        return view('pages.dashboard.bantuan.edit', compact('bantuan'));
    }

    public function update(UpdateBantuanRequest $request, Bantuan $bantuan)
    {
        try {
            $this->authorize('update', $bantuan);

            if ($request->hasFile('bukti')) {
                Storage::delete('public/bukti/' . $bantuan->bukti);
                $bantuan->bukti = basename($request->file('bukti')->store('public/bukti'));
            }
            
            $bantuan->jenis = $request->jenis;
            $bantuan->detail = $request->detail;

            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Bantuan $bantuan)
    {
        try {
            $this->authorize('delete', $bantuan);

            $bantuan->delete();

            return redirect()->route('dashboard.bantuan.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function approve(Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DISETUJUI';
            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function decline(Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DITOLAK';
            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function received(ReceiveBantuanRequest $request, Bantuan $bantuan)
    {
        try {
            $bantuan->status = 'DITERIMA';
            $bantuan->bukti = basename($request->file('bukti')->store('public/bukti'));

            $bantuan->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
