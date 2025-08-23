<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Supplier = Supplier::all();
        return view('pages.admin.supplier.index', compact('Supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:150',
            'nama_product' => 'nullable|string|max:150',
        ]);

        Supplier::create($request->all());

        return redirect()->route('Supplier.index')->with('success','Supplier berhasil ditambahkan.');
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
        $Supplier = Supplier::findOrFail($id);
        return view('pages.admin.supplier.edit', compact('Supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $Supplier)
    {
    $request->validate([
        'nama_supplier' => 'required|string|max:255',
        'kontak'        => 'nullable|string|max:100',
        'alamat'        => 'nullable|string',
        'nama_product' => 'nullable|string|max:150',
    ]);

    $Supplier->update([
        'nama_supplier' => $request->nama_supplier,
        'kontak'        => $request->kontak,
        'alamat'        => $request->alamat,
        'nama_product' => 'nullable|string|max:150',
    ]);

    return redirect()->route('Supplier.index')->with('success', 'Supplier berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $Supplier)
    {
         $Supplier->delete();
        return redirect()->route('Supplier.index')->with('success','Supplier berhasil dihapus.');
    }
}
