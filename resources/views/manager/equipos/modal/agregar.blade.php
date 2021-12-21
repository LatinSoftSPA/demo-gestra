<div class="modal fade modal-success" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_agregar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b class="modal-title" id="myModalLabel">Agregar Equipo</b>
			</div>
			{!! Form::open(['method' => 'POST', 'id' => 'frmAgregar']) !!}
			
			<div class="modal-body">
		        <!--	LOS TABs 	-->
		        <div class="bg-info">
		            <ul class="nav nav-pills nav-justified" role="tablist">
		                <li role="presentation" class="active"><a href="#addDataEquipo" aria-controls="addDataEquipo" role="tab" data-toggle="tab">Datos Equipo</a></li>
		                <li role="presentation"><a href="#addDataExtra" aria-controls="addDataExtra" role="tab" data-toggle="tab">Datos Extras</a></li>
		                <li role="presentation"><a href="#addAyuda" aria-controls="addAyuda" role="tab" data-toggle="tab">Ayuda</a></li>
		            </ul>
		        </div>

		        <!--	CONTENIDO de los TABs	-->
		        <div class="tab-content">
		        	<!-- PANEL 001 -->
		            <div role="tabpanel" class="tab-pane fade active in" id="addDataEquipo">
		            	@include('manager.formularios.frmDatosEquipo')
					</div>

		            <!-- PANEL 002 -->
		            <div role="tabpanel" class="tab-pane fade" id="addDataExtra">
		            	@include('manager.formularios.frmDatosEquipoExtras')
					</div>

					<!-- PANEL 004 -->
		            <div role="tabpanel" class="tab-pane fade" id="addAyuda">
		            	@include('formularios.frmAyuda')
					</div>
		        </div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-block btn-info" id="btnGuardar"> 
					<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar
				</button>
			</div>

			{!! Form::close() !!}
		</div>
	</div>
</div>