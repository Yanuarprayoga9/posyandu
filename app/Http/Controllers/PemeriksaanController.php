<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Anak;
use App\Models\JenisVitamin;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $tanggal = $request->get('tanggal');
        $vitamin = $request->get('vitamin');
        $urutan = $request->get('urutan', 'desc');

        $query = Pemeriksaan::with(['anak', 'pemberianVitamins.jenisVitamin']);

        // Filter search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('anak', function($q) use ($search) {
                    $q->where('nik_anak', 'like', "%{$search}%")
                        ->orWhere('nama_anak', 'like', "%{$search}%");
                })->orWhere('petugas', 'like', "%{$search}%");
            });
        }

        // Filter tanggal
        if ($tanggal) {
            $query->whereDate('tanggal_pemeriksaan', $tanggal);
        }

        // Filter vitamin
        if ($vitamin) {
            $query->whereHas('pemberianVitamins.jenisVitamin', function($q) use ($vitamin) {
                $q->where('kode_vitamin', $vitamin);
            });
        }

        // Urutan
        $query->orderBy('tanggal_pemeriksaan', $urutan);

        $pemeriksaans = $query->paginate($perPage)
            ->appends($request->query());

        return view('pemeriksaan.index', compact('pemeriksaans'));
    }

    public function create()
    {
        $anaks = Anak::orderBy('nama_anak')->get();
        $jenisVitamins = JenisVitamin::all();
        return view('pemeriksaan.create', compact('anaks', 'jenisVitamins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal_pemeriksaan' => 'required|date',
            'usia_bulan' => 'nullable|integer|min:0',
            'berat_badan' => 'nullable|numeric|min:0',
            'tinggi_badan' => 'nullable|numeric|min:0',
            'lingkar_kepala' => 'nullable|numeric|min:0',
            'lingkar_lengan_atas' => 'nullable|numeric|min:0',
            'suhu_tubuh' => 'nullable|numeric|min:0',
            'status_gizi' => 'nullable|in:Normal,Kurang,Buruk,Lebih,Obesitas',
            'petugas' => 'nullable|string|max:255',
            'tindakan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'vitamins' => 'nullable|array',
            'vitamins.*' => 'exists:jenis_vitamins,id'
        ]);

        // Konversi vitamin IDs menjadi string nama vitamin
        if ($request->has('vitamins') && !empty($request->vitamins)) {
            $vitaminNames = JenisVitamin::whereIn('id', $request->vitamins)
                ->pluck('nama_vitamin')
                ->toArray();
            $validated['vitamin_obat'] = implode(', ', $vitaminNames);
        }

        $pemeriksaan = Pemeriksaan::create($validated);

        // Simpan ke tabel pemberian_vitamins
        if ($request->has('vitamins') && !empty($request->vitamins)) {
            foreach ($request->vitamins as $vitaminId) {
                $pemeriksaan->pemberianVitamins()->create([
                    'jenis_vitamin_id' => $vitaminId,
                    'tanggal_pemberian' => $request->tanggal_pemeriksaan,
                ]);
            }
        }

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load(['anak', 'pemberianVitamins.jenisVitamin']);
        return view('pemeriksaan.show', compact('pemeriksaan'));
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        $anaks = Anak::orderBy('nama_anak')->get();
        $jenisVitamins = JenisVitamin::all();
        $pemeriksaan->load('pemberianVitamins');
        return view('pemeriksaan.edit', compact('pemeriksaan', 'anaks', 'jenisVitamins'));
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal_pemeriksaan' => 'required|date',
            'usia_bulan' => 'nullable|integer|min:0',
            'berat_badan' => 'nullable|numeric|min:0',
            'tinggi_badan' => 'nullable|numeric|min:0',
            'lingkar_kepala' => 'nullable|numeric|min:0',
            'lingkar_lengan_atas' => 'nullable|numeric|min:0',
            'suhu_tubuh' => 'nullable|numeric|min:0',
            'vitamin_obat' => 'nullable',
            'tindakan' => 'nullable',
            'status_gizi' => 'nullable|in:Normal,Kurang,Buruk,Lebih,Obesitas',
            'petugas' => 'nullable|max:255',
            'catatan' => 'nullable',
            'vitamin_ids' => 'nullable|array',
            'vitamin_ids.*' => 'exists:jenis_vitamins,id',
            'vitamin_jumlah' => 'nullable|array',
            'vitamin_keterangan' => 'nullable|array',
        ]);

        $pemeriksaan->update($validated);

        // Hapus pemberian vitamin lama
        $pemeriksaan->pemberianVitamins()->delete();

        // Simpan pemberian vitamin baru
        if ($request->has('vitamin_ids') && is_array($request->vitamin_ids)) {
            foreach ($request->vitamin_ids as $index => $vitaminId) {
                $pemeriksaan->pemberianVitamins()->create([
                    'jenis_vitamin_id' => $vitaminId,
                    'jumlah' => $request->vitamin_jumlah[$index] ?? null,
                    'keterangan' => $request->vitamin_keterangan[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data Pemeriksaan berhasil diupdate');
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data Pemeriksaan berhasil dihapus');
    }
}
