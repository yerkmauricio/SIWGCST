<?php

use App\Http\Controllers\AlimentosController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\DestinosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\FotoTourController;
use App\Http\Controllers\iniciocontroller;//ESTO SE IMPORTA DE MANERA AUTOMATICA
use App\Http\Controllers\HospedajesController;
use App\Http\Controllers\LisaliController;
use App\Http\Controllers\NJerarquicoController;
use App\Http\Controllers\ObsIncludeController;
use App\Http\Controllers\ObsNoincludeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RecibosController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\TransporteController;
use App\http\Controllers\UserControler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//PARA CREAR UN GRUPO DE RUTAS
Route::controller(iniciocontroller::class)->group(function(){

Route::get('/','login');//TRBAJANDO CON CONTROLADORES DE LA PARTE DE HTTP CONTROLLERS

// Route::get('/listado','show');

// Route::get('/tour','tour');

// Route::get('/welcome','welcome');

Route::get('/dashboard','dashboard')->middleware('can:dashboard');
 
// Route::get('/usuarios','usuario');

});
// Route::post('login', 'Auth\LoginController@authenticate');
//reando ruta de usuario y tiene que ser en plural 
Route::resource('/usuarios',UserControler::class);
// Route::resource('/tours',ToursController::class)->middleware('can:tours'); esto es par cuando no hay route resource y no directamente 
Route::resource('/tours',ToursController::class);
Route::get('/cotizacion', [ToursController::class, 'cotizacion'])->name('tours.cotizacion') ;
 

Route::resource('/transportes',TransporteController::class);
Route::resource('/cargos',CargoController::class)->except(['show']);
Route::resource('/productos',ProductosController::class);
Route::resource('/alimentos',AlimentosController::class)->except(['show']);
Route::resource('/empleados',EmpleadosController::class);
Route::resource('/hospedajes',HospedajesController::class);
Route::resource('/destinos',DestinosController::class);
Route::resource('/obs_includes',ObsIncludeController::class)->except(['show']);
Route::resource('/obs_noincludes',ObsNoincludeController::class)->except(['show']);

Route::resource('/lisalis',LisaliController::class);
Route::get('/admin', [LisaliController::class, 'admin'])->name('lisalis.admin');

Route::resource('/foto_tours',FotoTourController::class)->except(['show']);
Route::resource('/n_jerarquicos',NJerarquicoController::class)->except('show');
Route::resource('/areas',AreaController::class)->except('show');
Route::resource('/descuentos',DescuentoController::class)->except(['show']);
Route::resource('/clientes',ClientesController::class);
Route::resource('/reservas',ReservaController::class);
Route::resource('/recibos',RecibosController::class);

Route::get('/recibos/pdf/{recibo}', [RecibosController::class, 'pdf'])->name('recibos.pdf');

Route::resource('/calendarios',CalendarioController::class)->except(['create', 'destroy', 'update']);
Route::get('/calendarios/pdf/{recibo}', [CalendarioController::class, 'pdf'])->name('calendarios.pdf');
Route::get('/calendarios/alimento/{recibo}', [CalendarioController::class, 'alimento'])->name('calendarios.alimento');
Route::get('/calendarios/voucher/{recibo}', [CalendarioController::class, 'voucher'])->name('calendarios.voucher');

Route::resource('/estadisticas',EstadisticaController::class)->except(['destroy', 'update','show']);
 
Auth::routes();
Route::get('home',[App\Http\Controllers\HomeController::class,'index'])->name('home');


