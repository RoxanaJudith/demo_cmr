<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VerificacionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebcamController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('verificacion', VerificacionController::class);

Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
