<?php

use App\Events\QRLoginEvent;
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
    return view('welcome');
});

Route::view('play', 'play');

Route::group(['middleware' => 'auth'], function () {
    // login with qrcode
    Route::view('scan', 'scan');
    Route::get('qr', 'LoginQRCodeController@login');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


require __DIR__.'/auth.php';
