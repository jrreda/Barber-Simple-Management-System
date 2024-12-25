<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRecordController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::resource('barbers', BarberController::class);
Route::resource('services', ServiceController::class);
Route::resource('service_records', ServiceRecordController::class);

Route::get('locale/{locale}', function($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        App::setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
});
