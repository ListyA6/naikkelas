<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('modules.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/belajar', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/belajar/{module:slug}', [ModuleController::class, 'show'])->name('modules.show');
    Route::get('/belajar/{module:slug}/{lesson}', [ModuleController::class, 'lesson'])->name('lessons.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/lessons/{lesson}/toggle', [ProgressController::class, 'toggle'])->name('lessons.toggle');
});

require __DIR__.'/auth.php';
