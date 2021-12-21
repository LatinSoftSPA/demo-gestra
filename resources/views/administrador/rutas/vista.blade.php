@extends('admin.layout')


@section('content')
    @include('administrador.rutas.modal')    
	<div class="row">
		<div class="col-md-12">
			@include('administrador.rutas.listado')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>


	<script src="{{{ asset('js/adm/rutas/modRutas.js') }}}"></script>	
	<script src="{{{ asset('js/adm/rutas/lstRutas.js') }}}"></script>





	<script src="{{{ asset('js/adm/rutas/funMapaRutas.js') }}}"></script>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
	
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	
	<script src="{{{ asset('js/gmaps/funModalMapa.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funGeozonas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funKmz.js') }}}"></script>
@endsection