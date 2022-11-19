<?php

use App\Http\Controllers\Controller;
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
    return view('index');
});

// Getting and displaying requested data from Controller class
Route::post('/forecast', [Controller::class, 'forecast'])->name('forecast.page');
Route::get('/forecast/{location}', [Controller::class, 'forecast'])->name('forecast');

// Subscription to mailing list
Route::post('/subscribe', [Controller::class, 'subscribe'])->name('service.subscribe');
