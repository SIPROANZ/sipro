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

Route::resource('tipobos', App\Http\Controllers\TipoboController::class)->middleware('auth');

Route::resource('bos', App\Http\Controllers\BoController::class)->middleware('auth');

Route::resource('tipossgps', App\Http\Controllers\TipossgpController::class)->middleware('auth');

Route::resource('estados', App\Http\Controllers\EstadoController::class)->middleware('auth');

Route::resource('instituciones', App\Http\Controllers\InstitucioneController::class)->middleware('auth');

Route::resource('financiamientos', App\Http\Controllers\FinanciamientoController::class)->middleware('auth');

Route::resource('municipios', App\Http\Controllers\MunicipioController::class)->middleware('auth');

Route::resource('ejecuciondetalles', App\Http\Controllers\EjecuciondetalleController::class)->middleware('auth');

Route::resource('objetivoshistoricos', App\Http\Controllers\ObjetivoshistoricoController::class)->middleware('auth');

Route::resource('objetivosestrategicos', App\Http\Controllers\ObjetivosestrategicoController::class)->middleware('auth');

Route::resource('objetivonacionales', App\Http\Controllers\ObjetivonacionaleController::class)->middleware('auth');

Route::resource('objetivopeis', App\Http\Controllers\ObjetivopeiController::class)->middleware('auth');

Route::resource('unidadmedidas', App\Http\Controllers\UnidadmedidaController::class)->middleware('auth');

Route::resource('clasificadorpresupuestarios', App\Http\Controllers\ClasificadorpresupuestarioController::class)->middleware('auth');

Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');

Route::resource('productoscps', App\Http\Controllers\ProductoscpController::class)->middleware('auth');

//Route::resource('requisiciones', App\Http\Controllers\RequisicioneController::class)->middleware('auth');

Route::resource('poas', App\Http\Controllers\PoaController::class)->middleware('auth');

Route::resource('metas', App\Http\Controllers\MetaController::class)->middleware('auth');

Route::resource('ejercicios', App\Http\Controllers\EjercicioController::class)->middleware('auth');

Route::resource('segmentos', App\Http\Controllers\SegmentoController::class)->middleware('auth');

Route::resource('clases', App\Http\Controllers\ClaseController::class)->middleware('auth');

Route::resource('unidadadministrativas', App\Http\Controllers\UnidadadministrativaController::class)->middleware('auth');

Route::resource('ejecuciones', App\Http\Controllers\EjecucioneController::class)->middleware('auth');

Route::resource('objetivogenerales', App\Http\Controllers\ObjetivogeneraleController::class)->middleware('auth');

Route::resource('objetivomunicipales', App\Http\Controllers\ObjetivomunicipaleController::class)->middleware('auth');

Route::resource('familias', App\Http\Controllers\FamiliaController::class)->middleware('auth');

Route::resource('tipodecompromisos', App\Http\Controllers\TipodecompromisoController::class)->middleware('auth');

Route::resource('beneficiarios', App\Http\Controllers\BeneficiarioController::class)->middleware('auth');

Route::resource('proveedores', App\Http\Controllers\ProveedoreController::class)->middleware('auth');

Route::resource('ayudassociales', App\Http\Controllers\AyudassocialeController::class)->middleware('auth');

Route::resource('criterios', App\Http\Controllers\CriterioController::class)->middleware('auth');

Route::get('/analisis/agregar/{analisi}', [App\Http\Controllers\AnalisiController::class, 'agregar'])->name('analisis.agregar')->middleware('auth');



Route::patch('/analisis/aprobar/{analisi}', [App\Http\Controllers\AnalisiController::class, 'aprobar'])->name('analisis.aprobar')->middleware('auth');

Route::get('analisis/procesadas', [App\Http\Controllers\AnalisiController::class, 'indexprocesadas'])->name('analisis.procesadas')->middleware('auth');

Route::get('analisis/anuladas', [App\Http\Controllers\AnalisiController::class, 'indexanuladas'])->name('analisis.anuladas')->middleware('auth');

Route::patch('/analisis/anular/{analisi}', [App\Http\Controllers\AnalisiController::class, 'anular'])->name('analisis.anular')->middleware('auth');

Route::get('analisis/pdf/{analisi}', [App\Http\Controllers\AnalisiController::class, 'pdf'])->name('analisis.pdf')->middleware('auth');


Route::resource('analisis', App\Http\Controllers\AnalisiController::class)->middleware('auth');

Route::post('/detallesanalisis/storedos', [App\Http\Controllers\DetallesanalisiController::class, 'storedos'])->name('detallesanalisis.storedos')->middleware('auth');

Route::get('/detallesanalisis/createwithbos/{analisi}', [App\Http\Controllers\DetallesanalisiController::class, 'createwithbos'])->name('detallesanalisis.createwithbos')->middleware('auth');


Route::resource('detallesanalisis', App\Http\Controllers\DetallesanalisiController::class)->middleware('auth');

Route::resource('compras', App\Http\Controllers\CompraController::class)->middleware('auth');

Route::resource('detallesrequisiciones', App\Http\Controllers\DetallesrequisicioneController::class)->middleware('auth');

Route::get('/requisiciones/agregar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'agregar'])->name('requisiciones.agregar')->middleware('auth');

Route::get('requisiciones/pdf/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'pdf'])->name('requisiciones.pdf')->middleware('auth');

Route::get('requisiciones/procesadas', [App\Http\Controllers\RequisicioneController::class, 'indexprocesadas'])->name('requisiciones.procesadas')->middleware('auth');

Route::get('requisiciones/anuladas', [App\Http\Controllers\RequisicioneController::class, 'indexanuladas'])->name('requisiciones.anuladas')->middleware('auth');

Route::patch('/requisiciones/anular/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'anular'])->name('requisiciones.anular')->middleware('auth');

Route::patch('/requisiciones/aprobar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'aprobar'])->name('requisiciones.aprobar')->middleware('auth');

Route::resource('requisiciones', App\Http\Controllers\RequisicioneController::class)->middleware('auth');

