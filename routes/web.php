<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// google signin
Route::get('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');

// google signup
Route::post('auth/google/signup', [\App\Http\Controllers\GoogleController::class, 'signupWithGoogle'])->name('google.signup');

// handle google signup/signin
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);

