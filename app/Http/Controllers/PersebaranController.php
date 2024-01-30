<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersebaranRequest;
use App\Http\Requests\UpdatePersebaranRequest;
use App\Models\Penyandang;
use App\Models\Persebaran;

class PersebaranController extends Controller
{
    public function index()
    {
        $penyandang = Penyandang::all();

        return view('pages.dashboard.persebaran.index', compact('penyandang'));
    }

    public function create()
    {
        //
    }

    public function store(StorePersebaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Persebaran $persebaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persebaran $persebaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersebaranRequest $request, Persebaran $persebaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persebaran $persebaran)
    {
        //
    }
}
