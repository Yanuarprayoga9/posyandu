<?php


namespace App\Http\Controllers;

use App\Models\Imunisasi;
use App\Models\Anak;
use App\Models\JenisImunisasi;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search', '');

        $imunisasis = Imunisasi::with(['anak', 'jenisImunisasi'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('anak', function ($q) use ($search) {
                    $q->where('nik_anak', 'like', "%{$search}%")
                        ->orWhere('nama_anak', 'like', "%{$search}%")
                        ->orWhere('nama_ibu', 'like', "%{$search}%");
                })
                    ->orWhereHas('jenisImunisasi', function ($q) use ($search) {
                        $q->where('nama_imunisasi', 'like', "%{$search}%");
                    })
                    ->orWhere('petugas', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_imunisasi', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('imunisasi.index', compact('imunisasis'));
    }
    public function create()
    {
        $anaks = Anak::orderBy('nama_anak')->get();
        $jenisImunisasis = JenisImunisasi::orderBy('usia_target_bulan')->get();
        return view('imunisasi.create', compact('anaks', 'jenisImunisasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'jenis_imunisasi_id' => 'required|exists:jenis_imunisasis,id',
            'tanggal_imunisasi' => 'required|date',
            'usia_saat_imunisasi_bulan' => 'nullable|integer|min:0',
            'jenis_vaksin' => 'nullable|max:100',
            'keterangan' => 'nullable',
            'petugas' => 'nullable|max:255',
        ]);

        Imunisasi::create($validated);

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data Imunisasi berhasil ditambahkan');
    }

    public function show(Imunisasi $imunisasi)
    {
        $imunisasi->load(['anak', 'jenisImunisasi']);
        return view('imunisasi.show', compact('imunisasi'));
    }

    public function edit(Imunisasi $imunisasi)
    {
        $anaks = Anak::orderBy('nama_anak')->get();
        $jenisImunisasis = JenisImunisasi::orderBy('usia_target_bulan')->get();
        return view('imunisasi.edit', compact('imunisasi', 'anaks', 'jenisImunisasis'));
    }

    public function update(Request $request, Imunisasi $imunisasi)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'jenis_imunisasi_id' => 'required|exists:jenis_imunisasis,id',
            'tanggal_imunisasi' => 'required|date',
            'usia_saat_imunisasi_bulan' => 'nullable|integer|min:0',
            'jenis_vaksin' => 'nullable|max:100',
            'keterangan' => 'nullable',
            'petugas' => 'nullable|max:255',
        ]);

        $imunisasi->update($validated);

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data Imunisasi berhasil diupdate');
    }

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data Imunisasi berhasil dihapus');
    }
}
