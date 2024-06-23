<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('children/first-form', [ChildController::class, 'firstForm'])->name('children.firstForm');
    Route::post('children/first-form', [ChildController::class, 'postFirstForm'])->name('children.postFirstForm');

    Route::get('children/second-form', [ChildController::class, 'secondForm'])->name('children.secondForm');
    Route::post('children/second-form', [ChildController::class, 'postSecondForm'])->name('children.postSecondForm');

    Route::get('children', [ChildController::class, 'index'])->name('children.index');
});

require __DIR__.'/auth.php';
