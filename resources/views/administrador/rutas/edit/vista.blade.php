@extends('admin.layout')

@section('content')
    <div class="alert" id="alert"></div>
    
	<div class="row">
		{!! Form::open(['route' => ['rutas.update', $data['ruta']->codi_ruta], 'method' => 'PUT', 'id' => 'frmEditar']) !!}
			<div class="col-md-12">
				@include('administrador.rutas.edit.panelPrincipal')
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>


	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
	
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	
	<script src="{{{ asset('js/gmaps/funModalMapa.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funKmz.js') }}}"></script>
	<script src="{{{ asset('js/adm/rutas/edit/modRutas.js') }}}"></script>
@endsection