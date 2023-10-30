<?php

use App\Http\Controllers\{BandController, ItemController, MemberController, PatchlistController, RiderController, StuffController};
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
Route::match(['get', 'post'], '/band/{bandId}/edit', [BandController::class, 'edit'])->name('band.edit');

Route::get('/rider/{bandId}/list', [RiderController::class, 'list'])->name('rider.list');
Route::post('/rider/{bandId}/new', [RiderController::class, 'new'])->name('rider.new');
Route::match(['get', 'post'], '/rider/{riderId}/edit', [RiderController::class, 'edit'])->name('rider.edit');
Route::get('/rider/{riderId}/delete', [RiderController::class, 'delete'])->name('rider.delete');
Route::get('/rider/{riderId}/download', [RiderController::class, 'download'])->name('rider.download');
Route::get('/rider/{riderId}/preview', [RiderController::class, 'preview'])->name('rider.preview');
Route::get('/rider/{riderId}/duplicate', [RiderController::class, 'duplicate'])->name('rider.duplicate');

Route::get('/members/{bandId}/list', [MemberController::class, 'list'])->name('members.list');
Route::post('/members/{bandId}/save', [MemberController::class, 'save'])->name('members.save');

Route::get('/patchlist/enum', [PatchlistController::class, 'enum'])->name('patchlist.enum');
Route::get('/stuff/enum', [StuffController::class, 'enum'])->name('stuff.enum');
Route::get('/item/enum', [ItemController::class, 'enum'])->name('item.enum');

Route::get('/js/js-vars.js', function() {
    $content = view('js-vars');
    return response($content)->header('Content-Type', 'application/javascript');
})->name('js-vars');