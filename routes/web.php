<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitigationController;
use Livewire\Volt\Volt;
use App\Http\Controllers\RiskController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('mitigations', MitigationController::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Risk routes
    Route::get('risks', [RiskController::class, 'index'])->name('risks.index');
    Route::get('risks/create', [RiskController::class, 'create'])->name('risks.create');
    Route::post('risks', [RiskController::class, 'store'])->name('risks.store');
});

require __DIR__.'/auth.php';
