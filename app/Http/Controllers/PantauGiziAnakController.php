<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\PantauGiziAnak;
use Illuminate\Http\Request;

class PantauGiziAnakController extends Controller
{
    public function index(Request $request)
    {
        $query = PantauGiziAnak::with('anak');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('anak', function($q) use ($search) {
                $q->where('nik_anak', 'like', "%{$search}%")
                    ->orWhere('nama_anak', 'like', "%{$search}%");
            });
        }

        $pantauGizis = $query->latest('tanggal_pemeriksaan')
            ->paginate(10)
            ->withQueryString();

        return view('pantau-gizi.index', compact('pantauGizis'));
    }

    public function create()
    {
        $anaks = Anak::all();
        return view('pantau-gizi.create', compact('anaks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal_pemeriksaan' => 'required|date',
            'umur_bulan' => 'nullable|integer',
            'petugas' => 'nullable|string',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan_atas' => 'nullable|numeric',
            'kategori_gizi' => 'nullable|string',
            'frekuensi_makan' => 'nullable|integer',
            'frekuensi_camilan' => 'nullable|integer',
            'makanan_pokok' => 'nullable|string',
            'protein_hewani' => 'nullable|array',
            'asupan_asi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
        ]);

        $validated['konsumsi_sayur_buah'] = $request->has('konsumsi_sayur_buah');

        PantauGiziAnak::create($validated);

        return redirect()->route('pantau-gizi.index')->with('success', 'Data Pantau Gizi berhasil disimpan');
    }

    public function show($id)
    {
        $pantauGizi = PantauGiziAnak::with('anak')->findOrFail($id);
        $riwayat = PantauGiziAnak::where('anak_id', $pantauGizi->anak_id)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        return view('pantau-gizi.show', compact('pantauGizi', 'riwayat'));
    }
}

