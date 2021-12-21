@extends('admin.layout')


@section('cabecera_adicional')    
    <div class=" pull-right">
		<button type="button" class="btn btn-block btn-primary" id="btnImprimir"> 
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
		</button>
	</div>
@endsection

@section('content')
	<div class="row">
    	<div class="col-sm-3">
    		@include('manager.servicios.formulario')
    	</div>
		<div class="col-sm-9">
			@include('manager.servicios.listado')
		</div>
		
	</div>
@endsection


@section('listadoJS')
	<script src="{{{ asset('js/general.js') }}}"></script>

	<script src="{{{ asset('js/mng/servicios/lstServicios.js') }}}"></script>
	<script src="{{{ asset('js/mng/servicios/imprimir.js') }}}"></script>

	<script src="{{{ asset('js/require.min.js') }}}"></script>
@endsection