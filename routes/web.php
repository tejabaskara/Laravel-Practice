<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('home');
});

Route::get('/map', [LocationController::class, 'index'])->name('map.index');
Route::post('/map', [LocationController::class, 'store'])->name('map.store');

