<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;

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
    return view('auth.login');
});
/*
Route::get('/productoscrud', function () {
    return view('ProductosC.Index');
});

Route::get('/productoscrud/registro',[ProductosController::class,'create']);
*/

Route::resource('ProductosC',ProductosController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [ProductosController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/', [ProductosController::class, 'index'])->name('home');
});