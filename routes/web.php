<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('customers', CustomerController::class);

    Route::resource('vehicles', VehicleController::class);

    Route::get('customers/{id}/vehicles', [CustomerController::class, 'vehicles'])->name('customers.vehicles');

    Route::get('import/vehicles', [VehicleController::class, 'showImportForm'])->name('vehicles.import');
    Route::post('import/vehicles', [VehicleController::class, 'import'])->name('vehicles.import');

})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
