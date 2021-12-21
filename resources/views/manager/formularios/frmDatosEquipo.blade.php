<div class="panel panel-default">
    <div class="panel-body form-panel">
    
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                <div class="form-group">
                    {{ Form::label('deviceID', 'ID', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('deviceID', null, ['class' => 'form-control text-uppercase', 'id' => 'deviceID', 'placeholder' => 'Ej. 104099']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('imeiNumber', 'IMEI', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('imeiNumber', null, ['class' => 'form-control text-uppercase', 'id' => 'imeiNumber', 'placeholder' => 'IMEI']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('simPhoneNumber', 'Telefono', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('simPhoneNumber', null, ['class' => 'form-control text-uppercase', 'id' => 'simPhoneNumber', 'placeholder' => 'NUMERO CELULAR']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Numero de Telefono Movil)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('serialNumber', null, ['class' => 'form-control text-uppercase', 'id' => 'serialNumber', 'placeholder' => 'S/N SIM CARD']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Numero Serie de la Sim Card)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('isActive', 'Estado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default" id="btnHabilitado">
                                {{ Form::radio('isActive', 1, null, ['name' => 'isActive', 'id' => 'esHabilitado']) }}
                                <b class="hidden-sm hidden-xs">Habilitado</b>
                                <b class="hidden-md hidden-lg">H</b>
                            </label>
                            <label class="btn btn-default" id="btnDesHabilitado">
                                {{ Form::radio('isActive', 0, null, ['name' => 'isActive', 'id' => 'esDeshabilitado']) }}
                                <b class="hidden-sm hidden-xs">Deshabilitado</b>
                                <b class="hidden-md hidden-lg">D</b>
                            </label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>