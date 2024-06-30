<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('children', ChildController::class)->except(['create']);
    Route::get('/children/{id}/edit', [ChildController::class, 'edit'])->name('children.edit');
    Route::put('/children/{id}', [ChildController::class, 'update'])->name('children.update');
    Route::get('/children/{id}', [ChildController::class, 'show'])->name('children.show');

    // Untuk create-step-one dan create-step-two
    Route::get('create-step-one', [ChildController::class, 'createStepOne'])->name('children.createStepOne');
    Route::post('create-step-one', [ChildController::class, 'postCreateStepOne'])->name('children.postCreateStepOne');
    Route::get('create-step-two', [ChildController::class, 'createStepTwo'])->name('children.createStepTwo');
    Route::post('create-step-two', [ChildController::class, 'postCreateStepTwo'])->name('children.postCreateStepTwo');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
