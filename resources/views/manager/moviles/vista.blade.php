@extends('admin.layout')

@section('cabecera_adicional')    
    <div class=" pull-right">
		<button type="button" class="btn btn-block btn-success" id="btnAgregar"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
		</button>
	</div>
@endsection

@section('content')
	@include('manager.moviles.modal.editar')
	@include('manager.moviles.modal.agregar')

	<div class="row">
		<div class="col-md-12">
			@include('manager.moviles.listado')
        </div>        
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/modGeneral.js') }}}"></script>

	<script src="{{{ asset('js/mng/moviles/modMoviles.js') }}}"></script>
	<script src="{{{ asset('js/mng/moviles/lstMoviles.js') }}}"></script>

	<script src="{{{ asset('js/mng/moviles/agregarMovil.js') }}}"></script>
	<script src="{{{ asset('js/mng/moviles/editarMoviles.js') }}}"></script>
@endsection