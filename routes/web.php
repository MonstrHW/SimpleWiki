<?php

use App\Http\Controllers\ArticleController;
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
});

Route::get('/create', [ArticleController::class, 'create'])->name('create');
Route::post('/', [ArticleController::class, 'store'])->name('store');

Route::get('/{article}', [ArticleController::class, 'show'])->name('show');

Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
