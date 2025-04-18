<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Owner\CategoryController as OwnerCategoryController;
use App\Http\Controllers\Owner\PropertyController as OwnerPropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController as ControllersPropertyController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/', function () {
    return view('welcome');
});

// Les routes pour les utilisateurs authentifie
Route::middleware(['auth'])->group(function () use ($idRegex){

    // Les routes pour l'admin
    Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () use ($idRegex){
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
        Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('property/create', [PropertyController::class, 'create'])->name('property.create');
        Route::post('property/create', [PropertyController::class, 'store'])->name('property.store');
        Route::get('property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
        Route::put('property/{id}/edit', [PropertyController::class, 'update'])->name('property.update');
        Route::delete('property/{id}/delete', [PropertyController::class, 'destroy'])->name('property.delete');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{id}/edit', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.delete');

        Route::delete('picture/{id}', [PictureController::class, 'destroy'])->name('picture.destroy')->where([
                'picture' => $idRegex,
            ]);

        // Route::delete('picture/{picture}', [AdminPictureController::class, 'destroy'])->name('picture.destroy')->where([
        //     'picture' => $idRegex,
        // ]);
    });

    // Les routes pour le owner
    Route::prefix('owner')->middleware(['owner'])->name('owner.')->group(function () {
        Route::get('/dashboard', function () {
            return view('owner.dashboard');
        });
        Route::get('properties', [OwnerPropertyController::class, 'index'])->name('properties.index');
        Route::get('property/create', [OwnerPropertyController::class, 'create'])->name('property.create');
        Route::post('property/create', [OwnerPropertyController::class, 'store'])->name('property.store');
        Route::get('property/{id}/edit', [OwnerPropertyController::class, 'edit'])->name('property.edit');
        Route::put('property/{id}/edit', [OwnerPropertyController::class, 'update'])->name('property.update');
        Route::delete('property/{id}/delete', [OwnerPropertyController::class, 'destroy'])->name('property.delete');

        Route::get('categories', [OwnerCategoryController::class, 'index'])->name('categories.index');
        Route::get('category/create', [OwnerCategoryController::class, 'create'])->name('category.create');
        Route::post('category/create', [OwnerCategoryController::class, 'store'])->name('category.store');
        Route::get('category/{id}/edit', [OwnerCategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{id}/edit', [OwnerCategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{id}/delete', [OwnerCategoryController::class, 'destroy'])->name('category.delete');
    });

    // // Les routes pour le buyer
    // Route::prefix('byer')->middleware(['byer'])->name('byer.')->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('byer.dashboard');
    //     });
    // });
    // Route::get('properties', [ControllersPropertyController::class, 'index'])->name('properties.index');

});


Route::get('properties', [ControllersPropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [ControllersPropertyController::class, 'show'])->name('properties.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
