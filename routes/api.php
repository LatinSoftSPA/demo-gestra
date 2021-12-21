<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//http://localhost/laravel/public/api/propietarios/flota/104/96711420/8473210
Route::get('/propietarios/flota/{codi_linea}/{docu_empre}/{docu_perso}', 'Informes\PropietariosController@index');

Route::get('estadisticas/expediciones/{codi_circu}/{fech_consu}', 	'Gestion\EstadisticasController@listarExpediciones');
Route::get('estadisticas/servicios/{codi_circu}/{fech_consu}', 		'Gestion\EstadisticasController@listarServicios');
Route::get('estadisticas/multas/{codi_circu}/{fech_consu}', 		'Gestion\EstadisticasController@listarMultas');

//http://localhost/laravel/public/api/recaudacion/multas/17949063
Route::get('recaudaciones/multas/diarias/{fech_desde}/{fech_hasta}/{user_modif}', 'Recaudaciones\MultasController@listar')->name('multas.diarias');
//http://localhost/laravel/public/api/recaudacion/multas/17949063
Route::get('/recaudaciones/cuotas/diarias/{user_modif}', 'Recaudaciones\RecaudacionesController@CuotasDiarias')->name('cuotas.diarias');


//MONITORES DEL SISTEMA
Route::group(['prefix' => 'monitores'], function(){
	//http://localhost/laravel/public/api/monitores/frecuencia
	Route::get('frecuencia', 	'Monitores\FrecuenciaController@index');
	Route::get('listar/{docu_empre}/{codi_circu}/{fech_servi}', 		'Monitores\FrecuenciaController@listarServicios');
});

Route::get('/monitor/servicios/regularidad/{docu_empre}/{codi_circu}/{fech_servi}', 'Monitores\MonitorController@regularidadServicios');


//INFORMES DEL SISTEMA
//http://localhost/laravel/public/api/conductores/servicio/18/1549486500
Route::get('conductores/servicio/{codi_circu}/{codi_servi}', 'Informes\ConductoresController@index');
//Route::get('/tpublico/antofagasta/expediciones/{codi_linea}/{docu_empre}/{docu_perso}/{anio_consu}/{mes_consu}', 'InformesController@expedicionesFlota');
