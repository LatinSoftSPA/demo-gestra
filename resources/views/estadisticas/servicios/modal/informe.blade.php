<div class="modal fade modal-primary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_informe">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header  modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b class="modal-title" id="tituloModalInforme">Titulo Modal</b>
			</div>
			<div style="height:300px; overflow-y:scroll;">
				<table class="table table-striped table-hover table-condensed" id="tblListadoServicios">
		            <thead>
		                <tr class="info">
		                    <th class="text-center hidden-sm hidden-xs">ID</th>
		                    <th class="text-center hidden-sm hidden-xs">Punto de Control</th>
		                    <th class="text-center hidden-md hidden-lg">Control</th>
		                    <th class="text-center">Programada</th>
		                    <th class="text-center">Controlada</th>
		                    <th class="text-center">Tolerancia</th>
		                    <th class="text-center">Diferencia</th>
		                    <th class="text-center">Velocidad</th>
		                    <th class="text-center">Multa $</th>
		                </tr>
		            </thead>
		            <tbody class="table-responsive" id="listadoControles">
		                
		            </tbody>
		        </table>
			</div>
			<div class="modal-footer">
				<!--
				<button type="button" class="btn btn-lg btn-success btn-block" id="btnImprimirInforme">
					<span class="glyphicon glyphicon-printer" aria-hidden="true"> Imprimir</span>
				</button>
				-->
				<a href="#" class="btn btn-md btn-success btn-block btnImprimirInforme"><i class="fa fa-print fa-fw"></i> Imrpimir</a>
			</div>
		</div>
	</div>
</div>