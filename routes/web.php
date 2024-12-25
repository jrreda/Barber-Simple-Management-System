<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRecordController;
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('locale/{locale}', function($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        App::setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
});

// Owner-only routes here
Route::middleware(['auth', OwnerOnly::class])->group(function () {
    Route::resource('barbers', BarberController::class);
    Route::resource('services', ServiceController::class);
});

Route::middleware(['auth'])->group(function () {
    // Admin accessible routes here
    Route::resource('service_records', ServiceRecordController::class);
});
