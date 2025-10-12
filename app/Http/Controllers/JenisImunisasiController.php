<?php

namespace App\Http\Controllers;

use App\Models\JenisImunisasi;
use Illuminate\Http\Request;

class JenisImunisasiController extends Controller
{
    public function index()
    {
        $jenisImunisasis = JenisImunisasi::orderBy('usia_target_bulan')->get();
        return view('jenis-imunisasi.index', compact('jenisImunisasis'));
    }

    public function create()
    {
        return view('jenis-imunisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_imunisasi' => 'required|unique:jenis_imunisasis|max:20',
            'nama_imunisasi' => 'required|max:100',
            'deskripsi' => 'nullable',
            'usia_target_bulan' => 'nullable|integer|min:0',
        ]);

        JenisImunisasi::create($validated);

        return redirect()->route('jenis-imunisasi.index')
            ->with('success', 'Jenis Imunisasi berhasil ditambahkan');
    }

    public function show(JenisImunisasi $jenisImunisasi)
    {
        return view('jenis-imunisasi.show', compact('jenisImunisasi'));
    }

    public function edit(JenisImunisasi $jenisImunisasi)
    {
        return view('jenis-imunisasi.edit', compact('jenisImunisasi'));
    }

    public function update(Request $request, JenisImunisasi $jenisImunisasi)
    {
        $validated = $request->validate([
            'kode_imunisasi' => 'required|max:20|unique:jenis_imunisasis,kode_imunisasi,' . $jenisImunisasi->id,
            'nama_imunisasi' => 'required|max:100',
            'deskripsi' => 'nullable',
            'usia_target_bulan' => 'nullable|integer|min:0',
        ]);

        $jenisImunisasi->update($validated);

        return redirect()->route('jenis-imunisasi.index')
            ->with('success', 'Jenis Imunisasi berhasil diupdate');
    }

    public function destroy(JenisImunisasi $jenisImunisasi)
    {
        $jenisImunisasi->delete();

        return redirect()->route('jenis-imunisasi.index')
            ->with('success', 'Jenis Imunisasi berhasil dihapus');
    }
}
