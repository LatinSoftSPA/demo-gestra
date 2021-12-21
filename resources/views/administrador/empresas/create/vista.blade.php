@extends('template/master')
@section('titulo', 'Administrador de Empresas')

@section('contenido')
	<div class="row">
        @include('partials.titulo')
    </div>

    <div class="alert" id="alert"></div>
    
	<div class="row">
		<div class="col-md-12">
			@include('administrador.empresas.create.panelPrincipal')
		</div>
	</div>
@endsection

@section('listadoJS')
	<script src="{{{ asset('js/jquery.js') }}}"></script>
	<script src="{{{ asset('js/general.js') }}}"></script>
	<script src="{{{ asset('js/crear.js') }}}"></script>
@section('contenido')