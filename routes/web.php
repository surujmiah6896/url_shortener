<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashBoardController::class, 'dashboard'])->name('dashboard');

    //routes of url
    Route::get('/create-url', [UrlController::class, 'createUrl'])->name('url.create');
    Route::post('/store-url', [UrlController::class, 'storeUrl'])->name('url.store');
    Route::get('/delete-url/{url}', [UrlController::class, 'deleteUrl'])->name('url.delete');

    //route of user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/key/{shortenedUrl}', [UrlController::class, 'redirect']);

require __DIR__.'/auth.php';
