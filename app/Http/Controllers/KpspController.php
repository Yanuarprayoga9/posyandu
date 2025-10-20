<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Kpsp;
use Illuminate\Http\Request;

class KpspController extends Controller
{

    public function index(Request $request)
    {
        $query = Kpsp::with('anak');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('anak', function($q) use ($search) {
                $q->where('nik_anak', 'like', "%{$search}%")
                    ->orWhere('nama_anak', 'like', "%{$search}%");
            });
        }

        $kpsps = $query->latest('tanggal_pemeriksaan')
            ->paginate(10)
            ->withQueryString();

        return view('kpsp.index', compact('kpsps'));
    }

    public function create()
    {
        $anaks = Anak::all();
        return view('kpsp.create', compact('anaks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal_pemeriksaan' => 'required|date',
            'catatan' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
        ]);

        $validated['berdiri_berpegangan'] = $request->has('berdiri_berpegangan');
        $validated['berjalan_bantuan'] = $request->has('berjalan_bantuan');
        $validated['mengambil_benda_tangan'] = $request->has('mengambil_benda_tangan');
        $validated['mengambil_benda_kecil'] = $request->has('mengambil_benda_kecil');
        $validated['mengucap_suku_kata'] = $request->has('mengucap_suku_kata');
        $validated['merespon_saat_dipanggil'] = $request->has('merespon_saat_dipanggil');
        $validated['melepas_tangan'] = $request->has('melepas_tangan');
        $validated['menirukan_bunyi'] = $request->has('menirukan_bunyi');
        $validated['menunjuk_benda'] = $request->has('menunjuk_benda');
        $validated['minum_cangkir'] = $request->has('minum_cangkir');
        $validated['petugas'] = auth()->user()->name ?? 'Admin';

        Kpsp::create($validated);

        return redirect()->route('kpsp.index')->with('success', 'Data KPSP berhasil disimpan');
    }

}
