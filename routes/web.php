<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\NotificationController;
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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard untuk semua user
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', function () {
            return 'Admin Users Management';
        })->name('admin.users');
    });

    // Routes untuk kader dan admin
    Route::middleware('role:admin,kader')->group(function () {
        Route::get('/data-anak', function () {
            return 'Data Anak Management';
        })->name('data-anak');
    });
});

Route::resource('events', EventController::class);
//return controller notification
Route::get('/notification', [NotificationController::class, 'index']);
Route::prefix('anak')->name('anak.')->group(function () {
    Route::get('/', [AnakController::class, 'index'])->name('index');
    Route::get('/create', [AnakController::class, 'create'])->name('create');
    Route::post('/', [AnakController::class, 'store'])->name('store');
    Route::get('/{id}', [AnakController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AnakController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AnakController::class, 'update'])->name('update');
    Route::delete('/{id}', [AnakController::class, 'destroy'])->name('destroy');
});
