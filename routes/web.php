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

// Route::view('play', 'play');

// Route::get('/check', function() {

//     $session = DB::table('sessions')->find(session()->getId());
//     $a = unserialize(base64_decode($session->payload));
//     $a['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'] = 1;
//     // $a = base64_encode(serialize($a));
//     dd(auth()->id(), $a, session()->getId());
//     foreach($a as $key => $v) {
//         if (str_contains($key, 'login_web')) {
//             dd($key, $v);
//         }
//     }
// });

Route::get('trigger', function () {
    broadcast(new QRLoginEvent());
});

Route::get('session', function () {
    return session()->getId();
});
Route::get('qr', 'LoginQRCodeController@login')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
