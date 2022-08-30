<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VerificacionController;
use Illuminate\Support\Facades\Route;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\WebcamController;

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
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('verificacion', VerificacionController::class);

Route::get('send-email', function(){
    $mailData = [
        "name" => "Test NAME",
        "dob" => "12/12/1990"
    ];

    Mail::to("hello@example.com")->send(new TestEmail($mailData));

    dd("Mail Sent Successfully!");
});

Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/verificacion', [App\Http\Controllers\VerificacionController::class, 'store'])->name('verificacion');

