<div class="panel panel-default">
    <div class="panel-body form-panel">
        <div class="form-horizontal">

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="form-group">
                    {{ Form::label('habilitado', 'Estado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default" id="btnHabilitado">
                                {{ Form::radio('habilitado', 1, null, ['name' => 'habilitado', 'id' => 'esHabilitado']) }}
                                <b class="hidden-sm hidden-xs">Habilitado</b>
                                <b class="hidden-md hidden-lg">H</b>
                            </label>
                            <label class="btn btn-default" id="btnDesHabilitado">
                                {{ Form::radio('habilitado', 0, null, ['name' => 'habilitado', 'id' => 'esDeshabilitado']) }}
                                <b class="hidden-sm hidden-xs">Deshabilitado</b>
                                <b class="hidden-md hidden-lg">D</b>
                            </label>
                        </div>
                    </div>
                </div>                
            </div>

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			    <div style="height:250px;overflow-y:scroll;"><!--ACTIVAMOS EL SCROLL EN DIV CONTENEDOR DE LA TABLA-->
					<table class="table table-responsive table-striped table-condensed table-hover table-bordered">
					    <thead>
					        <tr class="info">
					            <th class="text-center">Movil</th>
					            <th class="text-center">PPT</th>
					            <th class="text-center">Rev. Tecnica</th>
					            <th class="text-center">Año</th>
					        </tr>
					    </thead>
					    <tbody id="listadoFlota">
					    
						</tbody>
					</tr>
					</table>
				</div>
			</div>

		</div>
    </div>
</div>