<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Anak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // Get upcoming events
        $upcomingEvents = Event::where('status', 'upcoming')
            ->where('tanggal_kegiatan', '>=', Carbon::now())
            ->orderBy('tanggal_kegiatan', 'asc')
            ->take(6)
            ->get();

        // Get recent completed events
        $recentEvents = Event::where('status', 'completed')
            ->whereNotNull('dokumentasi')
            ->latest()
            ->take(6)
            ->get();

        // Statistics
        $totalAnak = Anak::count();
        $totalBalita = Anak::whereBetween('tanggal_lahir_anak', [
            Carbon::now()->subYears(5),
            Carbon::now()
        ])->count();
        $totalEvent = Event::whereYear('tanggal_kegiatan', Carbon::now()->year)->count();

        return view('landing.index', compact(
            'upcomingEvents',
            'recentEvents',
            'totalAnak',
            'totalBalita',
            'totalEvent'
        ));
    }

    public function events()
    {
        $events = Event::latest('tanggal_kegiatan')->paginate(12);
        return view('landing.events', compact('events'));
    }

    public function eventDetail(Event $event)
    {
        return view('landing.event-detail', compact('event'));
    }
}

