@extends('admin.layout')

@section('cabecera_adicional')
    <div class=" pull-right">
		<button type="button" class="btn btn-block btn-success" id="btnAgregar"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
		</button>
	</div>
@endsection

@section('content')
	@include('manager.propietarios.modal.editar')
	@include('manager.propietarios.modal.agregar')
	<div class="row">
		<div class="col-md-12">	
			@include('manager.propietarios.listado')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/modGeneral.js') }}}"></script>
		
	<script src="{{{ asset('js/mng/propietarios/modPropietarios.js') }}}"></script>
	<script src="{{{ asset('js/mng/propietarios/lstPropietarios.js') }}}"></script>

	<script src="{{{ asset('js/mng/propietarios/editarPropietarios.js') }}}"></script>
	<script src="{{{ asset('js/mng/propietarios/agregarPropietarios.js') }}}"></script>
@endsection