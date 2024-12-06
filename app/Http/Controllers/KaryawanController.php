<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KaryawanRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $karyawans = Karyawan::paginate();

        return view('karyawan.index', compact('karyawans'))
            ->with('i', ($request->input('page', 1) - 1) * $karyawans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $karyawan = new Karyawan();

        return view('karyawan.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KaryawanRequest $request): RedirectResponse
    {
        Karyawan::create($request->validated());

        return Redirect::route('karyawans.index')
            ->with('success', 'Karyawan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $karyawan = Karyawan::find($id);

        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $karyawan = Karyawan::find($id);

        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KaryawanRequest $request, Karyawan $karyawan): RedirectResponse
    {
        $karyawan->update($request->validated());

        return Redirect::route('karyawans.index')
            ->with('success', 'Karyawan updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Karyawan::find($id)->delete();

        return Redirect::route('karyawans.index')
            ->with('success', 'Karyawan deleted successfully');
    }
}
