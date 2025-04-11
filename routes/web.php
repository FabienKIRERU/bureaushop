<?php

use App\Http\Controllers\Admin\CategoryController;
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
        Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('property/create', [PropertyController::class, 'create'])->name('property.create');
        Route::post('property/create', [PropertyController::class, 'store'])->name('property.store');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{id}/edit', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.delete');
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
