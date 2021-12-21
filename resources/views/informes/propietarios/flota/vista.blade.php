@extends('admin.app')
@section('titulo', 'Mi Informe Online')

@section('content')
<style>
	#divGMap{height:500px;}
</style>
<div class="row">
	<div class="panel panel-primary">    
		<div class="panel-heading text-center">
			<b class="panel-title">Mi Flota</b>
		</div>

		<div class="panel-body">
			<div class="media">
				<div class="media-left media-top">
					<img src="{{{ asset('img/avatar1.png') }}}" class="media-object" style="width:60px">
				</div>
				<div class="media-body">
					<b>Codigo: </b>{{ $misDatos[0]->docu_perso }} <small>({{ $misDatos[0]->nomb_empre }})</small>
					</br>
					<b>Nombre: </b>{{ $misDatos[0]->propietario }}
					</br>
					<b>Domicilio: </b>{{ $misDatos[0]->nomb_domic }} {{ $misDatos[0]->nume_domic }}
					</br>
					<b>Telefono Fijo: </b>{{ $misDatos[0]->tele_conta }}
					</br>
					<b>Telefono Movil: </b>{{ $misDatos[0]->movi_conta }}
					</br>
					<b>E-Mail: </b>{{ $misDatos[0]->mail_conta }}
					</br>
				</div>
			</div>
			<!--	LOS TABs 	-->
			<div>
				<ul class="nav nav-pills nav-justified" role="tablist">
					<li role="presentation" class="active"><a href="#tabMisMoviles" aria-controls="tabMisMoviles" role="tab" data-toggle="tab">Mis Moviles</a></li>
					<li role="presentation"><a href="#tabLosServicios" aria-controls="tabLosServicios" role="tab" data-toggle="tab">Servicios del Mes</a></li>
				</ul>
			</div>

			<!--	CONTENIDO de los TABs	-->
			<div class="tab-content">
				<!-- PANEL 001 -->
				<div role="tabpanel" class="tab-pane fade" id="tabLosServicios">
					@if(isset($laFlota))
						<div class="panel-group" id="lstFlota" role="tablist" aria-multiselectable="true">
							@foreach($laFlota as $movil)
								@include('informes.propietarios.flota.tablaMiServicio')
							@endforeach
						</div>
					@endif
				</div>

				<!-- PANEL 002 -->
				<div role="tabpanel" class="tab-pane fade active in" id="tabMisMoviles">						
						@include('informes.propietarios.flota.localizacionMoviles')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('listadoJS')
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funGeozonas.js') }}}"></script>
	
	<script src="{{{ asset('js/gmaps/funMarkers.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funBurbujas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/labelsMarkers.js') }}}"></script>
	
	
	<script src="{{{ asset('js/miFlota/funLocalizacion.js') }}}"></script>
@endsection