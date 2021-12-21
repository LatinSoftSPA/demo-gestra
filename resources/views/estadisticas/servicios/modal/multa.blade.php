<div class="modal fade modal-warning" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_multa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b class="modal-title" id="myModalLabel">Cobrar Multa</b>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-danger">
							<div class="panel-heading">Detalle del Servicio</div>
							<div class="panel-body">
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-horizontal">
											<div class="form-group">
												<div class="hidden-sm hidden-xs col-md-2">
										            {{ Form::label('hora_serv2', 'Servicio', ['class' => 'hidden-sm hidden-xs control-label']) }}
										        </div>									        
										        <div class="col-md-10">
										            {{ Form::time('hora_serv2', null, ['class' => 'form-control', 'id' => 'hora_serv2', 'readonly']) }}
										        </div>
										        <div class="col-md-10 col-md-offset-2">    
										            {{ Form::text('codi_servi', null, ['class' => 'form-control', 'id' => 'codi_servi', 'readonly']) }}
										        </div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-horizontal">
											<div class="form-group">
												<div class="hidden-sm hidden-xs col-md-2">
										            {{ Form::label('nume_maqui', 'Movil', ['class' => 'hidden-sm hidden-xs control-label']) }}
										        </div>									        
										        <div class="col-md-10">
										            {{ Form::number('nume_maqui', null, ['class' => 'form-control', 'id' => 'nume_maqui', 'readonly']) }}
										        </div>
										        <div class="col-md-10 col-md-offset-2">    
										            {{ Form::text('pate_maqui', null, ['class' => 'form-control', 'id' => 'pate_maqui', 'readonly']) }}
										        </div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-horizontal">
											<div class="form-group">
												<div class="hidden-sm hidden-xs col-md-1">
										            {{ Form::label('docu_condu2', 'Coductor', ['class' => 'hidden-sm hidden-xs control-label']) }}
										        </div>
										        <div class="col-md-3">
										            {{ Form::text('docu_condu2', null, ['class' => 'form-control', 'id' => 'docu_condu2', 'readonly']) }}
										        </div>
										        <div class="col-md-8">
										            {{ Form::text('nomb_condu', null, ['class' => 'form-control text-uppercase', 'id' => 'nomb_condu', 'readonly']) }}
										        </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">Detalle Multa</div>
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<div class="hidden-sm hidden-xs col-md-2">
											{{ Form::label('total_ida', 'IDA', ['class' => 'hidden-sm hidden-xs control-label']) }}
										</div>

										<div class="col-md-5">
											{{ Form::number('total_ida', 0, ['class' => 'form-control text-right', 'id' => 'total_ida', 'readonly']) }}
										</div>
								        <div class="col-md-5">
								            {{ Form::number('pagar_ida', 0, ['class' => 'form-control text-right', 'id' => 'pagar_ida']) }}
								        </div>

								        <div class="hidden-sm hidden-xs col-md-2">
								            {{ Form::label('total_regre', 'REG', ['class' => 'hidden-sm hidden-xs control-label']) }}
								        </div>
								        <div class="col-md-5">
								        	{{ Form::number('total_regre', 0, ['class' => 'form-control text-right', 'id' => 'total_regre', 'readonly']) }}
								        </div>
								        <div class="col-md-5">
								            {{ Form::number('pagar_regre', 0, ['class' => 'form-control text-right', 'id' => 'pagar_regre']) }}
								        </div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="panel panel-danger">
							<div class="panel-heading">Total</div>
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<div class="hidden-sm hidden-xs col-md-2">
											{{ Form::label('desc_total', 'Desc.', ['class' => 'hidden-sm hidden-xs control-label']) }}
										</div>

										<div class="col-md-10">
											{{ Form::text('desc_total', 0, ['class' => 'form-control text-right', 'id' => 'desc_total', 'readonly']) }}
										</div>
										<div class="hidden-sm hidden-xs col-md-2">
											{{ Form::label('tota_pagar', 'Total', ['class' => 'hidden-sm hidden-xs control-label']) }}
										</div>

										<div class="col-md-10">
											{{ Form::text('tota_pagar', 0, ['class' => 'form-control text-right', 'id' => 'tota_pagar', 'readonly']) }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="panel panel-danger">
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<div class="hidden-sm hidden-xs col-md-1">
											{{ Form::label('nume_movil', 'Nota', ['class' => 'hidden-sm hidden-xs control-label']) }}
										</div>
										<div class="col-md-11">
											{{ Form::text('nota_multa', null, ['class' => 'form-control text-uppercase', 'id' => 'nota_multa']) }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-success" id="btnPagar"> 
					<span class="fa fa-money fa-fw" aria-hidden="true"></span> Pagar
				</button>
			</div>
		</div>
	</div>
</div>