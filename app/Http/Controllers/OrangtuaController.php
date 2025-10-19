<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orangtua;

class OrangtuaController extends Controller
{
    /**
     * Tampilkan semua data orang tua.
     */
    public function index()
    {
        $orangtuas = Orangtua::latest()->paginate(10);
        return view('orangtua.index', compact('orangtuas'));
    }

    /**
     * Form tambah data orang tua.
     */
    public function create()
    {
        return view('orangtua.create');
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'nik_ibu' => 'required|string|max:16',
            'nama_ibu' => 'required|string|max:100',
            'tanggal_lahir_ibu' => 'required|date',
            'golongan_darah_ibu' => 'nullable|string|max:3',
            'nik_ayah' => 'required|string|max:16',
            'nama_ayah' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        Orangtua::create($request->all());

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    /**
     * Detail data orang tua.
     */
    public function show($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        return view('orangtua.show', compact('orangtua'));
    }

    /**
     * Form edit data orang tua.
     */
    public function edit($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        return view('orangtua.edit', compact('orangtua'));
    }

    /**
     * Update data orang tua.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'nik_ibu' => 'required|string|max:16',
            'nama_ibu' => 'required|string|max:100',
            'tanggal_lahir_ibu' => 'required|date',
            'golongan_darah_ibu' => 'nullable|string|max:3',
            'nik_ayah' => 'required|string|max:16',
            'nama_ayah' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $orangtua = Orangtua::findOrFail($id);
        $orangtua->update($request->all());

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil diperbarui.');
    }

    /**
     * Hapus data orang tua.
     */
    public function destroy($id)
    {
        $orangtua = Orangtua::findOrFail($id);
        $orangtua->delete();

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil dihapus.');
    }
}
