<?php
// app/Http/Controllers/\App\Models\AnakController.php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anak::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik_anak', 'like', "%{$search}%")
                    ->orWhere('nama_anak', 'like', "%{$search}%")
                    ->orWhere('nama_ibu', 'like', "%{$search}%")
                    ->orWhere('nama_ayah', 'like', "%{$search}%");
            });
        }

        // Filter Jenis Kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter Usia
        if ($request->has('usia') && $request->usia != '') {
            $today = Carbon::now();
            switch ($request->usia) {
                case '0-12':
                    $query->whereBetween('tanggal_lahir_anak', [
                        $today->copy()->subMonths(12),
                        $today
                    ]);
                    break;
                case '13-24':
                    $query->whereBetween('tanggal_lahir_anak', [
                        $today->copy()->subMonths(24),
                        $today->copy()->subMonths(13)
                    ]);
                    break;
                case '25-60':
                    $query->whereBetween('tanggal_lahir_anak', [
                        $today->copy()->subMonths(60),
                        $today->copy()->subMonths(25)
                    ]);
                    break;
                case '>60':
                    $query->where('tanggal_lahir_anak', '<', $today->copy()->subMonths(60));
                    break;
            }
        }

        // Sorting
        $urutan = $request->get('urutan', 'desc');
        switch ($urutan) {
            case 'asc':
                $query->oldest();
                break;
            case 'nama_asc':
                $query->orderBy('nama_anak', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama_anak', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $perPage = $request->get('per_page', 10);
        $anak = $query->paginate($perPage)->withQueryString();

        // Statistics
        $today = Carbon::now();
        $totalAnak = Anak::count();
        $totalLakiLaki = Anak::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Anak::where('jenis_kelamin', 'P')->count();
        $totalBalita = Anak::where('tanggal_lahir_anak', '>=', $today->copy()->subYears(5))->count();

        return view('anak.index', compact(
            'anak',
            'totalAnak',
            'totalLakiLaki',
            'totalPerempuan',
            'totalBalita'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anak.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik_anak' => 'required|string|unique:anaks,nik_anak|max:16',
            'nama_anak' => 'required|string|max:255',
            'tempat_lahir_anak' => 'nullable|string|max:255',
            'tanggal_lahir_anak' => 'nullable|date',
            'anak_ke' => 'nullable|integer|min:1',
            'golongan_darah' => 'nullable|string|max:2',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nama_ibu' => 'nullable|string|max:255',
        ], [
            'nik_anak.required' => 'NIK Anak wajib diisi',
            'nik_anak.unique' => 'NIK Anak sudah terdaftar',
            'nama_anak.required' => 'Nama Anak wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Anak::create($request->all());

            return redirect()->route('anak.index')
                ->with('success', 'Data anak berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $anak = Anak::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nik_anak' => 'required|string|max:16|unique:anaks,nik_anak,' . $id,
            'nama_anak' => 'required|string|max:255',
            'tempat_lahir_anak' => 'nullable|string|max:255',
            'tanggal_lahir_anak' => 'nullable|date',
            'anak_ke' => 'nullable|integer|min:1',
            'golongan_darah' => 'nullable|string|max:2',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nama_ibu' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $anak->update($request->all());

            return redirect()->route('anak.index')
                ->with('success', 'Data anak berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::findOrFail($id);
        return view('anak.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anak = Anak::findOrFail($id);
        return view('anak.edit', compact('anak'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $anak = Anak::findOrFail($id);
            $anak->delete();

            return redirect()->route('anak.index')
                ->with('success', 'Data anak berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
