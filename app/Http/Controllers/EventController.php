<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(9);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string|max:255',
            'sasaran_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('dokumentasi', $filename, 'public');
            $validated['dokumentasi'] = $path;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil disimpan!');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi_kegiatan' => 'required|string|max:255',
            'sasaran_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('dokumentasi')) {
            if ($event->dokumentasi) {
                Storage::disk('public')->delete($event->dokumentasi);
            }
            $file = $request->file('dokumentasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('dokumentasi', $filename, 'public');
            $validated['dokumentasi'] = $path;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy(Event $event)
    {
        if ($event->dokumentasi) {
            Storage::disk('public')->delete($event->dokumentasi);
        }
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }
}
