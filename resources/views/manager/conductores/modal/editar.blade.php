<div class="modal fade modal-warning" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_editar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b class="modal-title" id="myModalLabel">Editar Conductor</b>
			</div>
			{!! Form::open(['route' => ['conductores.actualizar'], 'method' => 'PUT', 'id' => 'frmEditar']) !!}
			
			<div class="modal-body">
		        <!--	LOS TABs 	-->
		        <div class="bg-info">
		            <ul class="nav nav-pills nav-justified" role="tablist">
		                <li role="presentation" class="active"><a href="#editDataPersona" aria-controls="editDataPersona" role="tab" data-toggle="tab">Datos Persona</a></li>
		                <li role="presentation"><a href="#editDataDomicilioContacto" aria-controls="editDataDomicilioContacto" role="tab" data-toggle="tab">Datos Contacto</a></li>
		                <li role="presentation"><a href="#editDataConductor" aria-controls="editDataConductor" role="tab" data-toggle="tab">Datos del Conductor</a></li>
		                <li role="presentation"><a href="#editAyuda" aria-controls="editAyuda" role="tab" data-toggle="tab">Ayuda</a></li>
		            </ul>
		        </div>

		        <!--	CONTENIDO de los TABs	-->
		        <div class="tab-content">
		        	<!-- PANEL 001 -->
		            <div role="tabpanel" class="tab-pane fade active in" id="editDataPersona">
		            	@include('manager.formularios.frmDatosPersona')
					</div>

		            <!-- PANEL 002 -->
		            <div role="tabpanel" class="tab-pane fade" id="editDataDomicilioContacto">
		            	@include('manager.formularios.frmDatosDomicilioContacto')
					</div>

					<!-- PANEL 003 -->
		            <div role="tabpanel" class="tab-pane fade" id="editDataConductor">
		            	@include('manager.formularios.frmDatosConductor')
					</div>
					<!-- PANEL 004 -->
		            <div role="tabpanel" class="tab-pane fade" id="editAyuda">
		            	@include('formularios.frmAyuda')
					</div>
		        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-block btn-success" id="btnActualizar"> 
					<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Actualizar
				</button>
			</div>

			{!! Form::close() !!}
		</div>
	</div>
</div>