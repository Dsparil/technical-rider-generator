<?php

use App\Http\Controllers\{BandController, RiderController};
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BandController::class, 'list'])->name('band.list');
Route::get('/rider/{bandId}/list', [RiderController::class, 'list'])->name('rider.list');

Route::get('/js/js-vars.js', function() {
    $content = view('js-vars');
    return response($content)->header('Content-Type', 'application/javascript');
})->name('js-vars');