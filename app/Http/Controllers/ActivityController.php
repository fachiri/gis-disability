<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Documentation;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::where('relawan_id', auth()->user()->relawan->id)->get();

        return view('pages.dashboard.kegiatan.index', compact('activities'));
    }

    public function create()
    {
        return view('pages.dashboard.kegiatan.create');
    }

    public function store(StoreActivityRequest $request)
    {
        try {
            $activity = Activity::create(
                $request->only([
                    'name', 'location'
                ]) + [
                    'relawan_id' => auth()->user()->relawan?->id
                ]
            );

            foreach ($request->documentations as $documentation) {
                Documentation::create([
                    'name' => basename($documentation->store('public/documentations')),
                    'activity_id' => $activity->id
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Activity $activity)
    {
        return view('pages.dashboard.kegiatan.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('pages.dashboard.kegiatan.edit', compact('activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        try {
            $activity->name = $request->name;
            $activity->location = $request->location;

            $activity->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Activity $activity)
    {
        try {
            $activity->delete();

            return redirect()->route('dashboard.activity.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
