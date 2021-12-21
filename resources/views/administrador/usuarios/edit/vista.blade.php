@extends('template/master')
@section('titulo', 'Manager Usuarios')

@section('contenido')
	<div class="row">
	    <div class="col-md-12">
	        <h3 class="page-header">
	        	Editar Usuario
	        	<a href="{{ route('usuarios.index') }}" class="btn btn-warning pull-right">
	        		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver
	        	</a>
	        </h3>
	    </div>
    </div>
    
    <div class="alert" id="alert"></div>    

	<div class="row">
		{!! Form::open(['route' => ['usuarios.update', $objPersona[0]->docu_perso], 'method' => 'PUT', 'id' => 'frmEditar']) !!}
			<div class="col-md-12">
				@include('usuarios.edit.panelPrincipal')
			</div>
		{!! Form::close() !!}
	</div>
@endsection


@section('listadoJS')
	<script src="{{{ asset('js/jquery.js') }}}"></script>
	<script src="{{{ asset('js/editar.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>
@section('contenido')