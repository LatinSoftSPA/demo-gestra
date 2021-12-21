@extends('admin.layout')

@section('title', $data['title'])

@section('content')
    <div class="row">
    	@include('manager.panelPrincipal')
    </div>	
@endsection

@section('listadoJS')
	<!--
	<script src="{{{ asset('js/jquery.min.js') }}}"></script>
	-->
@endsection