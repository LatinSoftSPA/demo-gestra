<div class="modal" tabindex="-1" role="dialog" data-show="true" id="modal_procesar">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header  modal-header-warning">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Procesando Servicios</h4>
			</div>
				<div class="modal-body">
					<p>
                        <strong>Maquina: <small id="nume_movilXXX"></small></strong>
                        <span class="pull-right text-muted" id="elPorcentaje1"></span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" id="barraProsesandoServicios" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only" id="elPorcentaje2"></span>
                        </div>
                    </div>
                    <p><strong>Total Servicio(s): <small id="totalServicios">XXX</small></strong></p>
					<p><strong>Servicio COD: <small id="procesandoServicio">YYY</small></strong></p>
					<p><strong>Marcadas: <small id="totalMarcadas">YYY</small></b></p>
				</div>
				
				<div class="modal-footer">
				</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" data-show="true" data-hide="true" id="modal_sin_servicios">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header  modal-header-info">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Felicidades</h4>
			</div>
				<div class="modal-body">
					<h4>¡¡¡No se encontraron Servicios para Procesar!!!</h4>
				</div>
		</div>
	</div>
</div>