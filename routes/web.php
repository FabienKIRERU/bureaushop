<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Les routes pour les utilisateurs authentifie
Route::middleware(['auth'])->group(function () {

    // Les routes pour l'admin
    Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
        Route::get('property', [PropertyController::class, 'index'])->name('property.index');
        Route::get('property/create', [PropertyController::class, 'create'])->name('property.create');
        Route::post('property/create', [PropertyController::class, 'store'])->name('property.store');
    });

    // Les routes pour le owner
    Route::prefix('owner')->middleware(['owner'])->name('owner.')->group(function () {
        Route::get('/dashboard', function () {
            return view('owner.dashboard');
        });
    });

    // Les routes pour le buyer
    Route::prefix('byer')->middleware(['byer'])->name('byer.')->group(function () {
        Route::get('/dashboard', function () {
            return view('byer.dashboard');
        });
    });

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
