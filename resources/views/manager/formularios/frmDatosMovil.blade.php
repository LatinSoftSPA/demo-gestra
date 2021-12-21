<div class="panel panel-default">
	<div class="panel-body form-panel">
		<div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                <div class="form-group">
                    {{ Form::label('nume_movil', 'Movil', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                        {{ Form::text('nume_movil', null, ['class' => 'form-control text-uppercase', 'id' => 'nume_movil', 'maxlength' => '3', 'required' => 'required', 'placeholder' => 'Numero']) }}
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                        {{ Form::text('pate_movil', null, ['class' => 'form-control text-uppercase', 'id' => 'pate_movil', 'maxlength' => '6', 'required' => 'required', 'placeholder' => 'Patente']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('fech_revis', 'R. Tecnica', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                        {{ Form::date('fech_revis', null, ['class' => 'form-control text-uppercase', 'id' => 'fech_revis']) }}
                        <em class="help-block hidden-md hidden-lg" id="helpBlock"><small>(Vencimiento R. Tecnica)</small></em>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                        {{ Form::text('anio_movil', null, ['class' => 'form-control text-uppercase', 'id' => 'anio_movil', 'maxlength' => '4', 'required' => 'required', 'placeholder' => 'Año']) }}
                    </div>
                </div>
                
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

                <div class="form-group">
                    <label for="docu_perso" class="col-md-2 col-lg-2 hidden-sm hidden-xs control-label">Propietario</label>
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::select('docu_perso', 
                            $data['lstPropietarios'], 
                            null, ['class' => 'form-control', 'id' => 'docu_perso', 'placeholder' => 'Asociar...']) 
                        }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="thumbnail">
                    <img src="{{{ asset('img/taxibus.jpg') }}}" class="img-responsive img-rounded">
                </div>
            </div>

        </div>
	</div>
</div>