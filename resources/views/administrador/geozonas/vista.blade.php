@extends('admin.layout')

@section('cabecera_adicional')
    <div class=" pull-right">
		<button type="button" class="btn btn-block btn-success" id="btnAgregar">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
		</button>
	</div>
@endsection

@section('content')
	@include('administrador.geozonas.modal.editar')
	@include('administrador.geozonas.modal.mapa')
	<div class="row">
		<div class="col-md-12">
			@include('administrador.geozonas.listado')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>

	<script src="{{{ asset('js/adm/geozonas/modGeozonas.js') }}}"></script>
	<script src="{{{ asset('js/adm/geozonas/lstGeoZonas.js') }}}"></script>





	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
	
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	
	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funGeozonas.js') }}}"></script>
@endsection