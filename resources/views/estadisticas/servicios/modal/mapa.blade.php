<div class="modal fade modal-primary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_mapa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header  modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b class="modal-title" id="tituloModalGeozona">Trazado del Recorrido</b>
			</div>
			<div id="floating-panel">
				<b id="tiempo">
					00:00:00
				</b>
			</div>

			<div id="divGMap" style="position: relative; width: 100%; height: 400px"></div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-md-2">
						<a href="#!" class="btn btn-block btn-danger btnIda" role="button">
							<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Ida
						</a>
					</div>
					<div class="col-md-8">
						<input class="pull-left slider" id="btnRango" type="range" min="0" max="0" value="0" step="1">
					</div>


					<div class="col-md-2">
						<a href="#!" class="btn btn-block btn-primary btnRegreso" role="button">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regreso
						</a>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>