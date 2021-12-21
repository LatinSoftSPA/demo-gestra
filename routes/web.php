<?php

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\Manager\ConductoresController;
use App\Http\Controllers\Gestion\ServiciosController;
use App\Http\Controllers\Gestion\EstadisticasController;
use App\Http\Controllers\Gestion\ExpedicionesController;
use App\Http\Controllers\Recaudaciones\RecaudacionesController;
use App\Http\Controllers\Recaudaciones\MultasController;

use App\Http\Controllers\BienvenidaController;

Route::get('/', [BienvenidaController::class, 'index'])->name('bienvenida');
Route::get('/home', [BienvenidaController::class, 'index']);
Route::get('/bienvenida', [BienvenidaController::class, 'index']);


Route::get('administracion', [AdministracionController::class, 'index'])->name('administracion');
Route::get('informes', [InformesController::class, 'index'])->name('informes');
Route::get('manager', [ManagerController::class, 'index'])->name('manager');


Route::group(['prefix' => 'recaudaciones'], function () {
	Route::get('estadisticas', [RecaudacionesController::class, 'index'])->name('recaudaciones.estadisticas');
	Route::get('estadisticas/multas', [MultasController::class, 'listar']);
	Route::get('informes/multas/imprimir', [MultasController::class, 'imprimir']);
});



Route::group(['prefix' => 'gestion'], function () {
	Route::get('servicios', [ServiciosController::class, 'index'])->name('servicios.index');
	/*----------------------------------------------------------------------*/
	Route::get('estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas.index');
	Route::get('estadisticas/expediciones', [EstadisticasController::class, 'listarExpediciones']);
	Route::get('estadisticas/servicios', [EstadisticasController::class, 'listarServicios']);
	Route::get('estadisticas/multas', [EstadisticasController::class, 'listarMultas']);
	/*----------------------------------------------------------------------*/
	Route::post('servicios/listar', [ServiciosController::class, 'listar'])->name('listar.servicios');
	Route::post('servicios/filtrar', [ServiciosController::class, 'filtrar'])->name('filtrar.servicio');
	Route::post('servicios/buscar', [ServiciosController::class, 'buscar'])->name('buscar.servicio');
	Route::post('servicios/eliminar', [ServiciosController::class, 'eliminar'])->name('eliminar.servicio');
	Route::post('servicios/registrar', [ServiciosController::class, 'registrar'])->name('registrar.servicio');
	Route::post('servicios/cobrar/multa', [ServiciosController::class, 'cobrarMulta']);


	Route::post('servicios/imprimir', [ServiciosController::class, 'imprimir'])->name('imprimir.servicio');
	Route::post('informes/imprimir', [ServiciosController::class, 'imprimirInforme'])->name('imprimir.informe');


	Route::post('servicios/buscar/movil', [ServiciosController::class, 'buscarMovil']);
	Route::post('servicios/buscar/conductor', [ServiciosController::class, 'buscarConductor']);
	Route::post('servicios/analizar', [ServiciosController::class, 'analizarServicios']);
	Route::post('servicios/procesar', [ServiciosController::class, 'procesarServicio']);



	Route::post('servicios/finalizar', 	[ServiciosController::class, 'finalizarServicios'])->name('servicios.finalizar');
	Route::post('servicios/finalizar2', [ServiciosController::class, 'finalizarServicio'])->name('servicios.finalizar');
	//Route::post('procesar/servicio', 	[ServiciosController::class, 'procesarServicio'])->name('procesar.servicio');
	Route::post('listar/expediciones', 	[ExpedicionesController::class, 'listarExpediciones2'])->name('expediciones.servicio');

	Route::post('servicios/pendientes', [ServiciosController::class, 'serviciosPendientes'])->name('servicios.pendiente');
	Route::post('servicio/existe', 		[ServiciosController::class, 'existeServicio'])->name('existe.servicio');

	Route::put('actualizar/programadas', 'Gestion\ProgramadasController@update')->name('actualizar.programadas');


	/*----------------------------------------------------------------------*/
	Route::post('pago/imprimir', 'Imprimir\PagosController@imprimir')->name('imprimir.pago');

	Route::post('imprimir/recaudacion/multas', 'Imprimir\RecaudacionPagosController@imprimir')->name('imprimir.recaudacion.multas');
	/*----------------------------------------------------------------------*/
	Route::post('listar/arribos', 		'Track\ArribosController@listarArribos')->name('listar.arribos');
	//Route::post('servicios/buscar/conductor', 	[ServiciosController::class, 'buscarConductor');
});





Route::group(['prefix' => 'recau'], function () {
	//Route::get('estadisticas', 		'Recaudaciones\RecaudacionesController@index')->name('recaudaciones.estadisticas');
	Route::get('listar/multas', 	'Recaudaciones\RecaudacionesController@listarMultas')->name('listar.multas');
});

//RUTAS: INFORMES
Route::group(['prefix' => 'inf'], function () {
	Route::get('servicios', 				'Informes\ServiciosController@index')->name('informes.servicios');

	Route::get('servicios/listar', 			'Informes\ServiciosController@listar');
});

//RUTAS: ADMINISTRACION
Route::group(['prefix' => 'adm'], function () {
	Route::get('circuitos', 				'Administrador\CircuitosController@index')->name('administrar.circuitos');
	Route::get('geozonas', 					'Administrador\GeozonasController@index')->name('administrar.geozonas');
	Route::get('rutas', 					'Administrador\RutasController@index')->name('administrar.rutas');
	/*----------------------------------------------------------------------*/


	Route::resource('usuarios', 'Admin\UsuariosController');
	Route::resource('empresas', 'Admin\EmpresasController');
	/*----------------------------------------------------------------------*/


	/*----------------------------------------------------------------------*/
	//Route::get('filtrar/ruta', 'Admin\RutasController@filtrarRutas')->name('filtar.ruta');
	//Route::get('listar/rutas', 'Admin\RutasController@listarRutas');
	Route::get('rutas/{codi_ruta}/buscar/ruta', 'Admin\RutasController@show');
	/*----------------------------------------------------------------------*/
	//Route::put('geozonas/actualizar', 	'Administrador\GeozonasController@actualizar')->name('geozonas.actualizar');
	//Route::post('geozonas/buscar', 			'Administrador\GeozonasController@buscar');
	//Route::post('geozonas/eliminar', 		'Administrador\GeozonasController@eliminar');
	Route::get('circuitos/filtrar', 		'Administrador\CircuitosController@filtrar');
	//Route::post('geozonas/guardar', 		'Administrador\GeozonasController@guardar');
	Route::get('circuitos/listar', 			'Administrador\CircuitosController@listar');
	/*----------------------------------------------------------------------*/
	//Route::put('geozonas/actualizar', 	'Administrador\GeozonasController@actualizar')->name('geozonas.actualizar');
	Route::post('geozonas/buscar', 			'Administrador\GeozonasController@buscar');
	//Route::post('geozonas/eliminar', 		'Administrador\GeozonasController@eliminar');
	Route::get('geozonas/filtrar', 			'Administrador\GeozonasController@filtrar');
	//Route::post('geozonas/guardar', 		'Administrador\GeozonasController@guardar');
	Route::get('geozonas/listar', 			'Administrador\GeozonasController@listar');
	/*----------------------------------------------------------------------*/
	//Route::put('rutas/actualizar', 		'Administrador\RutasController@actualizar')->name('rutas.actualizar');
	//Route::post('rutas/buscar', 			'Administrador\RutasController@buscar');
	//Route::post('rutas/eliminar', 		'Administrador\RutasController@eliminar');
	Route::get('rutas/filtrar', 			'Administrador\RutasController@filtrar');
	//Route::post('rutas/guardar', 			'Administrador\RutasController@guardar');
	Route::get('rutas/listar', 				'Administrador\RutasController@listar');
});

//RUTAS: MANAGER
Route::group(['prefix' => 'mng'], function () {
	Route::get('conductores', [ConductoresController::class, 'index'])->name('manager.conductores');
	Route::get('propietarios', 					'Manager\PropietariosController@index')->name('manager.propietarios');
	Route::get('moviles', 						'Manager\MovilesController@index')->name('manager.moviles');
	Route::get('equipos', 						'Manager\EquiposController@index')->name('manager.equipos');

	Route::put('conductores/actualizar', [ConductoresController::class, 'actualizar'])->name('conductores.actualizar');
	Route::post('conductores/buscar', [ConductoresController::class, 'buscar']);
	Route::post('conductores/eliminar', [ConductoresController::class, 'eliminar']);
	Route::get('conductores/filtrar', [ConductoresController::class, 'filtrar']);
	Route::post('conductores/guardar', [ConductoresController::class, 'guardar']);
	Route::get('conductores/listar', [ConductoresController::class, 'listar']);
	/*----------------------------------------------------------------------*/
	Route::put('propietarios/actualizar', 		'Manager\PropietariosController@actualizar')->name('propietarios.actualizar');
	Route::post('propietarios/buscar', 			'Manager\PropietariosController@buscar');
	Route::post('propietarios/eliminar', 		'Manager\PropietariosController@eliminar');
	Route::get('propietarios/filtrar', 			'Manager\PropietariosController@filtrar');
	Route::post('propietarios/guardar', 		'Manager\PropietariosController@guardar');
	Route::get('propietarios/listar', 			'Manager\PropietariosController@listar');
	/*----------------------------------------------------------------------*/
	Route::put('moviles/actualizar', 			'Manager\MovilesController@actualizar')->name('moviles.actualizar');
	Route::post('moviles/buscar', 				'Manager\MovilesController@buscar');
	Route::post('moviles/eliminar', 			'Manager\MovilesController@eliminar');
	Route::get('moviles/filtrar', 				'Manager\MovilesController@filtrar');
	Route::post('moviles/guardar', 				'Manager\MovilesController@guardar');
	Route::get('moviles/listar', 				'Manager\MovilesController@listar');
	/*----------------------------------------------------------------------*/
	Route::put('equipos/actualizar', 			'Manager\EquiposController@actualizar')->name('equipos.actualizar');
	Route::post('equipos/buscar', 				'Manager\EquiposController@buscar');
	//Route::post('equipos/eliminar', 			'Manager\EquiposController@eliminar');
	Route::get('equipos/filtrar', 				'Manager\EquiposController@filtrar');
	Route::post('equipos/guardar', 				'Manager\EquiposController@guardar');
	Route::get('equipos/listar', 				'Manager\EquiposController@listar');
	/*----------------------------------------------------------------------*/
	Route::resource('expediciones', 'Gestion\ExpedicionesController', ['parameters' => ['docu_empre' => 'docu_empre']]);

	Route::get('expediciones/listar', [ExpedicionesController::class, 'listarExpediciones'])->name('expediciones.listar');
});



// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
