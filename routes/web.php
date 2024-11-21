<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\Admin\CarModelController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

// USER ROUTES

Route::get('/about', function () {
    return view('about');
})->middleware('auth', 'verified');

Route::get('/fleet', function () {
    return view('fleet');
})->middleware(['auth', 'verified', 'rolemanager:user'])->name('fleet');

Route::get('/fleet/{id}', [FleetController::class, 'show'])->middleware(['auth', 'verified', 'rolemanager:user'])->name('fleet.show');

Route::get('/arrangement', function () {
    return view('arrangement');
})->middleware(['auth', 'verified', 'rolemanager:user'])->name('arrangement');

// ADMIN ROUTES

Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/cars/manage', 'manageCars')->name('admin.cars.manage');

            Route::get('/users/manage', 'manageUsers')->name('admin.users.manage');
        });

        Route::controller(CarModelController::class)->group(function() {
            Route::get('/carmodels/manage', 'index')->name('manage.carmodel');
            Route::get('/carmodels/create', 'create')->name('create.carmodel');
            Route::post('/carmodels/store', 'store')->name('store.carmodel');
            Route::get('/carmodels/edit/{id}', 'edit')->name('edit.carmodel');
            Route::put('/carmodels/update/{id}', 'update')->name('update.carmodel');
            Route::delete('/carmodels/delete/{id}', 'delete')->name('delete.carmodel');
        });

    });
});

// SUPERADMIN ROUTES



// OTHER ROUTES

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

