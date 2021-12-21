<div class="modal fade modal-success" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_salidas">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header  modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Registrar Servicio</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'registrar.servicio', 'method' => 'POST', 'id' => 'frmAgregar']) !!}
				<div class="form-horizontal">
				    <div class="form-group">
				        <div class="hidden-sm hidden-xs col-md-2">
				            {{ Form::label('nume_movil', 'Movil', ['class' => 'hidden-sm hidden-xs control-label']) }}
				        </div>
				        <div class="col-md-5">
				            {{ Form::number('nume_movil', null, ['class' => 'form-control text-uppercase', 'id' => 'nume_movil', 'maxlength' => '3', 'required' => 'required', 'placeholder' => 'Numero']) }}
				        </div>

				        <div class="col-md-5">
				        	{{ Form::text('codi_equip', null, ['class' => 'form-control text-uppercase', 'id' => 'codi_equip', 'placeholder' => 'Codigo', 'readonly']) }}
				        </div>
				        <div class="col-md-5 col-md-offset-2">    
				            {{ Form::text('pate_movil', null, ['class' => 'form-control text-uppercase', 'id' => 'pate_movil', 'placeholder' => 'Patente', 'readonly']) }}
				        </div>

				        <div class="col-md-5">    
				            {{ Form::text('fech_revis', null, ['class' => 'form-control text-uppercase', 'id' => 'fech_revis', 'placeholder' => 'Fecha', 'readonly']) }}
				        </div>
				    </div>

				    <div class="form-group">
				        <div class="hidden-sm hidden-xs col-md-2">
				            {{ Form::label('codi_licen', 'Coductor', ['class' => 'hidden-sm hidden-xs control-label']) }}
				        </div>
				        <div class="col-md-5">
				            {{ Form::number('codi_licen', null, ['class' => 'form-control text-uppercase', 'id' => 'codi_licen', 'maxlength' => '8', 'required' => 'required', 'placeholder' => 'Codigo']) }}
				        </div>
				        <div class="col-md-5">
				        	{{ Form::text('docu_condu', null, ['class' => 'form-control text-uppercase', 'id' => 'docu_condu', 'placeholder' => 'R.U.N', 'readonly']) }}
				        </div>

				        <div class="col-md-10 col-md-offset-2">
				        	{{ Form::text('fech_venci', null, ['class' => 'form-control text-uppercase', 'id' => 'fech_venci', 'placeholder' => 'Fecha', 'readonly']) }}
				        </div>
				        <div class="col-md-5 col-md-offset-2">
				        	{{ Form::text('prim_nombr', null, ['class' => 'form-control text-uppercase', 'id' => 'prim_nombr', 'placeholder' => 'PNombre', 'readonly']) }}
				        </div>

				        <div class="col-md-5">
				            {{ Form::text('segu_nombr', null, ['class' => 'form-control text-uppercase', 'id' => 'segu_nombr', 'placeholder' => 'SNombre', 'readonly']) }}
				        </div>
				        
				        <div class="col-md-5 col-md-offset-2">
				            {{ Form::text('apel_pater', null, ['class' => 'form-control text-uppercase', 'id' => 'apel_pater', 'placeholder' => 'APaterno', 'readonly']) }}
				        </div>

				        <div class="col-md-5">
				            {{ Form::text('apel_mater', null, ['class' => 'form-control text-uppercase', 'id' => 'apel_mater', 'placeholder' => 'AMaterno', 'readonly']) }}				            
				        </div>
				    </div>


				    <div class="form-group">
				        <div class="hidden-sm hidden-xs col-md-2">
				            {{ Form::label('hora_servi', 'Inicio', ['class' => 'hidden-sm hidden-xs control-label']) }}
				        </div>
				        <div class="col-md-5">
				            {{ Form::time('hora_servi', '00:00', ['class' => 'form-control text-uppercase', 'id' => 'hora_servi']) }}
				        </div>
				        <div class="col-md-5">
				            {{ Form::checkbox('impr_servi', 'value', true, ['class' => '', 'id' => 'impr_servi']) }}
				            {{ Form::label('impr_servi', 'Imprimir', ['class' => 'control-label']) }}
				        </div>
				    </div>
				</div>
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">			
			  <button type="button" class="btn btn-block btn-success" disabled="disabled" id="btnGuardar"> 
				<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Guardar
			  </button>
			</div>
		</div>
	</div>
</div>