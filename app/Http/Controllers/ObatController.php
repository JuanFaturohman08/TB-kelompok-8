<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Obat::query();

        // Filter pencarian
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('nama_obat', 'like', "%{$q}%")
                    ->orWhere('kode', 'like', "%{$q}%")
                    ->orWhere('kategori', 'like', "%{$q}%");
            });
        }

        // Filter stok rendah
        if ($request->boolean('low_stock')) {
            $query->whereColumn('stok', '<', 'stok_minimum');
        }

        $obats = $query->orderBy('nama_obat')->get();

        return view('obats.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:obats,kode',
            'nama_obat' => 'required|string|max:255',
            'kandungan' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'bentuk' => 'nullable|string|max:50',
            'satuan' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'lokasi_rak' => 'nullable|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
            'produsen' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:100',
        ]);

        $validated['is_aktif'] = $request->boolean('is_aktif');

        Obat::create($validated);

        return redirect()->route('obats.index')
            ->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        return view('obats.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('obats.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:obats,kode,' . $obat->id,
            'nama_obat' => 'required|string|max:255',
            'kandungan' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'bentuk' => 'nullable|string|max:50',
            'satuan' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'lokasi_rak' => 'nullable|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
            'produsen' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:100',
        ]);

        $validated['is_aktif'] = $request->boolean('is_aktif');

        $obat->update($validated);

        return redirect()->route('obats.index')
            ->with('success', 'Obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obats.index')
            ->with('success', 'Obat berhasil dihapus.');
    }

    /**
     * Display stock management page (admin only).
     */
    public function stock()
    {
        $obats = Obat::orderBy('nama_obat')->get();

        return view('obats.stock', compact('obats'));
    }
}
