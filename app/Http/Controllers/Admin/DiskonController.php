<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diskon = Diskon::orderByDesc('nilai')->get();
        return view('pages.admin.diskon.index', compact('diskon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.diskon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'tipe' => 'required|in:potongan,persen',
            'nilai' => 'required|integer|min:1',
            'min_belanja' => 'nullable|integer|min:0',
            'min_qty' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        Diskon::create($request->all());
        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diskon = Diskon::findOrFail($id);
        return view('pages.admin.diskon.edit', compact('diskon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'tipe' => 'required|in:potongan,persen',
            'nilai' => 'required|integer|min:1',
            'min_belanja' => 'nullable|integer|min:0',
            'min_qty' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        $diskon = Diskon::findOrFail($id);
        $diskon->update($request->all());

        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();

        return redirect()->route('Diskon.index')->with('success', 'Diskon berhasil dihapus!');
    }

        public function aktif()
    {
        return Diskon::where('status', 1)->orderByDesc('nilai')->get();
    }
}
