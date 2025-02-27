<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.landing');
});
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/maintenance', function () {
        return view('maintenance');
    })->name('maintenance');
    
    Route::get('/specialist', function () {
        return view('specialist');
    })->name('specialist');

    Route::get('/draftable', function () {
        return view('draftable');
    })->name('draftable');
});
