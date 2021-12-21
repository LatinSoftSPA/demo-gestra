@extends('admin.layout')


@section('content')
    @include('administrador.circuitos.modal')
    <div class="alert" id="alert"></div>
    
	<div class="row">
		<div class="col-md-12">
			@include('administrador.circuitos.listado')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>

	<script src="{{{ asset('js/adm/circuitos/modCircuitos.js') }}}"></script>
	<script src="{{{ asset('js/adm/circuitos/funMapaCircuitos.js') }}}"></script>
	

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
	
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funGeozonas.js') }}}"></script>
@endsection