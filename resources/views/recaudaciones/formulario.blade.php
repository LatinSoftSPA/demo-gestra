<div class="panel  bg-green">
	<div class="panel-heading">
		<h1 class="panel-title">Formulario</h1>
	</div>
	<div class="panel-body">
		<div class="form-group form-group-md">
			{{ Form::date('fech_desde', \Carbon\Carbon::now(), ['class' => 'form-control text-uppercase', 'id' => 'fech_desde']) }}
			{{ Form::select('nomb_usuar', 
			$data['lstUsuarios'], 
			null, ['class' => 'form-control text-uppercase', 'id' => 'nomb_usuar', 'placeholder' => 'Seleccionar']) 
			}}
			{{ Form::text('docu_perso', \Auth::user()->docu_perso, ['class' => 'form-control ', 'id' => 'docu_perso', 'readonly']) }}
		</div>
	</div>

	<!--
	<div class="panel-footer bg-green">
		<button type="button" class="btn btn-info btn-block" id="btnConsultar"> 
			<span class="glyphicon glyphicon-list" aria-hidden="true"></span> Detallar
		</button>
	</div>
	-->
</div>	