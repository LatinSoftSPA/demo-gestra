@extends('template/master')
@section('titulo', 'Reg. Usuario')

@section('contenido')
	<div class="row">
	    <div class="col-md-12">
	        <h3 class="page-header">
	        	Crear Usuario
	        	<a href="{{ route('administracion') }}" class="btn btn-warning pull-right">
	        		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver
	        	</a>
	        </h3>
	    </div>
    </div>

    <div class="alert" id="alert"></div>
    
	<div class="row">
		{!! Form::open(['route' => 'usuarios.store', 'method' => 'POST', 'id' => 'frmAgregar']) !!}
			<div class="col-md-12">
				@include('usuarios.create.panelPrincipal')
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/crear.js') }}}"></script>
@section('contenido')