@extends('admin.layout')


@section('cabecera_adicional')
    @include('estadisticas.formulario')
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			@include('estadisticas.listado')
		</div>
	</div>
@endsection


@section('listadoJS')
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/est/servicios/lstExpediciones.js') }}}"></script>
	<script src="{{{ asset('js/est/servicios/lstServicios.js') }}}"></script>
	<script src="{{{ asset('js/est/servicios/lstMultas.js') }}}"></script>


	<script src="{{{ asset('js/highcharts.js') }}}"></script>
	<script src="{{{ asset('js/est/servicios/confGrafico.js') }}}"></script>
	<script src="{{{ asset('js/est/servicios/dataGrafico.js') }}}"></script>
@endsection