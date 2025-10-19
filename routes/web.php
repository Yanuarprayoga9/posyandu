<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\laporanController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

// Guest routes (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('orangtua', \App\Http\Controllers\OrangtuaController::class);




    // Dashboard untuk semua user
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
      Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        // === API METRICS untuk auto-refresh Dashboard ===
    Route::get('/api/dashboard/metrics', function () {
        // Ambil data langsung dari database
        return response()->json([
            'total'     => \App\Models\Anak::count(),
            'laki'      => \App\Models\Anak::where('jenis_kelamin', 'L')->count(),
            'perempuan' => \App\Models\Anak::where('jenis_kelamin', 'P')->count(),
        ]);
    })->name('api.dashboard.metrics')
      ->middleware('throttle:30,1'); // batasi 30 request per menit
});





// 🧩 Kalau BELUM pakai sistem login (auth), gunakan versi ini sementara:
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/api/dashboard/metrics', function () {
//     return response()->json([
//         'total'     => \App\Models\Anak::count(),
//         'laki'      => \App\Models\Anak::where('jenis_kelamin', 'L')->count(),
//         'perempuan' => \App\Models\Anak::where('jenis_kelamin', 'P')->count(),
//     ]);
// })->name('api.dashboard.metrics')->middleware('throttle:30,1');

    // Routes khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', function () {
            return 'Admin Users Management';
        })->name('admin.users');
    });

//    // Routes untuk kader dan admin
//    Route::middleware('role:admin,kader')->group(function () {
//        Route::get('/data-anak', function () {
//            return 'Data Anak Management';
//        })->name('data-anak');
//});

Route::resource('events', EventController::class);
//return controller notification
Route::get('/notification', [NotificationController::class, 'index']);
//Route::prefix('anak')->name('anak.')->group(function () {
//    Route::get('/', [AnakController::class, 'index'])->name('index');
//    Route::get('/create', [AnakController::class, 'create'])->name('create');
//    Route::post('/', [AnakController::class, 'store'])->name('store');
//    Route::get('/{id}', [AnakController::class, 'show'])->name('show');
//    Route::get('/{id}/edit', [AnakController::class, 'edit'])->name('edit');
//    Route::put('/{id}', [AnakController::class, 'update'])->name('update');
//    Route::delete('/{id}', [AnakController::class, 'destroy'])->name('destroy');
//});
//

Route::middleware('role:admin,kader')->group(function () {

    // ==========================================
    // ANAK ROUTES
    // ==========================================
    Route::get('anak', [AnakController::class, 'index'])->name('anak.index');
    Route::get('anak/create', [AnakController::class, 'create'])->name('anak.create');
    Route::post('anak', [AnakController::class, 'store'])->name('anak.store');
    Route::get('anak/{anak}', [AnakController::class, 'show'])->name('anak.show');
    Route::get('anak/{anak}/edit', [AnakController::class, 'edit'])->name('anak.edit');
    Route::put('anak/{anak}', [AnakController::class, 'update'])->name('anak.update');
    Route::delete('anak/{anak}', [AnakController::class, 'destroy'])->name('anak.destroy');

    // ==========================================
    // IMUNISASI ROUTES
    // ==========================================
    Route::get('imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');
    Route::get('imunisasi/create', [ImunisasiController::class, 'create'])->name('imunisasi.create');
    Route::post('imunisasi', [ImunisasiController::class, 'store'])->name('imunisasi.store');
    Route::get('imunisasi/{imunisasi}', [ImunisasiController::class, 'show'])->name('imunisasi.show');
    Route::get('imunisasi/{imunisasi}/edit', [ImunisasiController::class, 'edit'])->name('imunisasi.edit');
    Route::put('imunisasi/{imunisasi}', [ImunisasiController::class, 'update'])->name('imunisasi.update');
    Route::delete('imunisasi/{imunisasi}', [ImunisasiController::class, 'destroy'])->name('imunisasi.destroy');

    // ==========================================
    // PEMERIKSAAN ROUTES
    // ==========================================
    Route::get('pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');
    Route::get('pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
    Route::post('pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
    Route::get('pemeriksaan/{pemeriksaan}', [PemeriksaanController::class, 'show'])->name('pemeriksaan.show');
    Route::get('pemeriksaan/{pemeriksaan}/edit', [PemeriksaanController::class, 'edit'])->name('pemeriksaan.edit');
    Route::put('pemeriksaan/{pemeriksaan}', [PemeriksaanController::class, 'update'])->name('pemeriksaan.update');
    Route::delete('pemeriksaan/{pemeriksaan}', [PemeriksaanController::class, 'destroy'])->name('pemeriksaan.destroy');

    // ==========================================
    // EVENT ROUTES
    // ==========================================
    Route::get('event', [EventController::class, 'index'])->name('event.index');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event', [EventController::class, 'store'])->name('event.store');
    Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::get('event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
});
