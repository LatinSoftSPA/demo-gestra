@extends('layouts.monitores')

@section('content')
	<div class="background container-fluid">

	    <div class="row">
	        <div class="col-md-12">
	            <div class="boxHora">
	            	<h1 class="txtHora">--:--:--</h1>
	            </div>
	        </div>
	        <div class="col-md-12">
	            <div class="boxTitulo">
	                <p>{{ $data['title']}} <small>{{ $data['subtitle']}}</small></p>
	            </div>
	        </div>
	    </div>

		<div class="row">
			<div class="col-md-8">
				@include('monitores.frecuencia.listado')
			</div>

			<div class="col-md-4">
			    <div id="capaMapa">
			        <div id="divGMap"></div>
			    </div>
			</div>
			</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/monitores/funReloj.js') }}}"></script>
	<script src="{{{ asset('js/monitores/funServicios.js') }}}"></script>
	<script src="{{{ asset('js/monitores/funLocalizar.js') }}}"></script>
<!--
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCpcjpET_egxZ-KiFlQwio0x7HLFjcphgc"></script>
-->
	<script src="https://maps.googleapis.com/maps/api/js"></script>

	<script src="{{{ asset('js/gmaps/labelsMarkers.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funMapas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funMarkers.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funBurbujas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funGeozonas.js') }}}"></script>
	<script src="{{{ asset('js/gmaps/funKmz.js') }}}"></script>

	<script src="{{{ asset('js/gmaps/mapaLathinSoft.js') }}}"></script>
@endsection