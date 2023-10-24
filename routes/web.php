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
Route::get('/band/new', [BandController::class, 'new'])->name('band.new');

Route::get('/rider/{bandId}/list', [RiderController::class, 'list'])->name('rider.list');
Route::get('/rider/{bandId}/new', [RiderController::class, 'new'])->name('rider.new');
Route::match(['get', 'post'], '/rider/{riderId}/edit', [RiderController::class, 'edit'])->name('rider.edit');
Route::get('/rider/{riderId}/delete', [RiderController::class, 'delete'])->name('rider.delete');
Route::get('/rider/{riderId}/download', [RiderController::class, 'download'])->name('rider.download');
Route::get('/rider/{riderId}/duplicate', [RiderController::class, 'duplicate'])->name('rider.duplicate');

Route::get('/js/js-vars.js', function() {
    $content = view('js-vars');
    return response($content)->header('Content-Type', 'application/javascript');
})->name('js-vars');