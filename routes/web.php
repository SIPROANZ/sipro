<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('tipossgps', App\Http\Controllers\TipossgpController::class)->middleware('auth');

Route::resource('estados', App\Http\Controllers\EstadoController::class)->middleware('auth');

Route::resource('financiamientos', App\Http\Controllers\FinanciamientoController::class)->middleware('auth');

Route::resource('municipios', App\Http\Controllers\MunicipioController::class)->middleware('auth');

Route::resource('ejecuciondetalles', App\Http\Controllers\EjecuciondetalleController::class)->middleware('auth');

Route::resource('objetivoshistoricos', App\Http\Controllers\ObjetivoshistoricoController::class)->middleware('auth');

Route::resource('objetivosestrategicos', App\Http\Controllers\ObjetivosestrategicoController::class)->middleware('auth');

Route::resource('objetivonacionales', App\Http\Controllers\ObjetivonacionaleController::class)->middleware('auth');

Route::resource('objetivopeis', App\Http\Controllers\ObjetivopeiController::class)->middleware('auth');

Route::resource('unidadmedidas', App\Http\Controllers\unidadmedidaController::class)->middleware('auth');
