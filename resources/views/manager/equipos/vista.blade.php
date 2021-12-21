@extends('admin.layout')

@section('cabecera_adicional')    
    <div class=" pull-right">
		<button type="button" class="btn btn-block btn-success" id="btnAgregar"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
		</button>
	</div>
@endsection

@section('content')
	@include('manager.equipos.modal.editar')
	@include('manager.equipos.modal.agregar')
	<div class="row">
		<div class="col-md-12">
			@include('manager.equipos.listado')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/modGeneral.js') }}}"></script>

	<script src="{{{ asset('js/mng/equipos/modEquipos.js') }}}"></script>
	<script src="{{{ asset('js/mng/equipos/lstEquipos.js') }}}"></script>

	<script src="{{{ asset('js/mng/equipos/agregarEquipos.js') }}}"></script>
	<script src="{{{ asset('js/mng/equipos/editarEquipos.js') }}}"></script>
@endsection