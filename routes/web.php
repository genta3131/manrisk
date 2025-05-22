<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitigationController;
use Livewire\Volt\Volt;
use App\Http\Controllers\RiskController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Contoh: Hanya admin dan super admin yang bisa mengakses mitigations
Route::resource('mitigations', MitigationController::class)->middleware(['auth', 'role:super admin|admin']);


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Risk routes
    // Hanya 'super admin', 'admin', 'owner risk', dan 'pimpinan' yang bisa melihat daftar risiko
    Route::get('risks', [RiskController::class, 'index'])->name('risks.index')->middleware('role:super admin|admin|owner risk|pimpinan');
    // Hanya 'super admin' dan 'owner risk' yang bisa membuat risiko
    Route::get('risks/create', [RiskController::class, 'create'])->name('risks.create')->middleware('role:super admin|owner risk');
    Route::post('risks', [RiskController::class, 'store'])->name('risks.store')->middleware('role:super admin|owner risk');
});

require __DIR__.'/auth.php';