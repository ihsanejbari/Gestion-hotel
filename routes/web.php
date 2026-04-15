<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ChambreController as AdminChambre;
use App\Http\Controllers\Admin\ReservationController as AdminReservation;
use App\Http\Controllers\Admin\AvisController as AdminAvis;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;

// ========================
// ROUTES GUEST (publiques)
// ========================
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/chambres', [GuestController::class, 'chambres'])->name('guest.chambres');
Route::get('/avis', [GuestController::class, 'avis'])->name('guest.avis');

// ========================
// ROUTES ADMIN
// ========================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chambres', AdminChambre::class);
    Route::resource('reservations', AdminReservation::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('avis', AdminAvis::class)->only(['index', 'destroy']);
});

// ========================
// ROUTES CLIENT
// ========================
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
    Route::get('/chambres', [ClientDashboard::class, 'chambres'])->name('chambres');
    Route::get('/reservations', [ClientDashboard::class, 'reservations'])->name('reservations');
    Route::post('/reservations', [ClientDashboard::class, 'storeReservation'])->name('reservations.store');
    Route::get('/paiements', [ClientDashboard::class, 'paiements'])->name('paiements');
    Route::post('/paiements', [ClientDashboard::class, 'storePaiement'])->name('paiements.store');
    Route::get('/avis', [ClientDashboard::class, 'avis'])->name('avis');
    Route::post('/avis', [ClientDashboard::class, 'storeAvis'])->name('avis.store');
});

// Redirection dashboard générique (pour les liens Breeze)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') return redirect()->route('admin.dashboard');
    return redirect()->route('client.dashboard');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';