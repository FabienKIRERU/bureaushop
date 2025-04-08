<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Les routes pour l'admin
Route::prefix('admin')->middleware(['admin', 'auth'])->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

// Les routes pour le owner
Route::prefix('owner')->middleware(['owner', 'auth'])->name('owner.')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    });
});

// Les routes pour le byer
Route::prefix('byer')->middleware(['byer', 'auth'])->name('byer.')->group(function () {

    Route::get('/dashboard', function () {
        return view('byer.dashboard');
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
