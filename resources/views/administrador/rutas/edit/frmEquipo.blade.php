<div class="panel panel-default">
    <div class="panel-body form-panel">
    
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">


                <div class="form-group">
                    {{ Form::label('deviceID', 'ID', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('deviceID', $data['equipo'][0]->deviceID, ['class' => 'form-control text-uppercase', 'id' => 'deviceID', 'disabled' => 'disabled', 'placeholder' => 'COD DEVICE']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('imeiNumber', 'IMEI', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('imeiNumber', $data['equipo'][0]->imeiNumber, ['class' => 'form-control text-uppercase', 'id' => 'imeiNumber', 'placeholder' => 'IMEI']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('simPhoneNumber', 'Telefono', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('simPhoneNumber', $data['equipo'][0]->simPhoneNumber, ['class' => 'form-control text-uppercase', 'id' => 'simPhoneNumber', 'disabled' => 'disabled', 'placeholder' => 'NUMERO CELULAR']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Numero de Telefono Movil)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('serialNumber', $data['equipo'][0]->serialNumber, ['class' => 'form-control text-uppercase', 'id' => 'serialNumber', 'disabled' => 'disabled', 'placeholder' => 'S/N SIM CARD']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Numero Serie de la Sim Card)</small></em>
                    </div>
                </div>
<hr>

                <div class="form-group">
                    {{ Form::label('description', 'Labels', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('description', $data['equipo'][0]->description, ['class' => 'form-control text-uppercase', 'id' => 'description', 'placeholder' => 'LABEL MAPA']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Label Se Reflejara en los Mapas)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('displayName', $data['equipo'][0]->displayName, ['class' => 'form-control text-uppercase', 'id' => 'displayName', 'placeholder' => 'LABEL BURBUJAS']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Label Se Reflejara en las Burbujas)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('licensePlate', 'Patente', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('licensePlate', $data['equipo'][0]->licensePlate, ['class' => 'form-control text-uppercase', 'id' => 'licensePlate', 'placeholder' => 'PLACA PATENTE']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Placa Patente del Movil)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('vehicleYear', $data['equipo'][0]->vehicleYear, ['class' => 'form-control text-uppercase', 'id' => 'vehicleYear', 'placeholder' => 'AÑO MOVIL']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Año del Movil)</small></em>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('accountID', 'Asociado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('accountID', $data['equipo'][0]->accountID, ['class' => 'form-control text-uppercase', 'id' => 'accountID', 'disabled' => 'disabled', 'placeholder' => 'ACCOUNT ID']) }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('groupID', $data['equipo'][0]->groupID, ['class' => 'form-control text-uppercase', 'id' => 'groupID', 'disabled' => 'disabled', 'placeholder' => 'GROUP ID']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('driverID', 'Coductor', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('driverID', $data['equipo'][0]->driverID, ['class' => 'form-control text-uppercase', 'id' => 'driverID', 'disabled' => 'disabled', 'placeholder' => 'CODIGO CONDUCTOR']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Codigo Conductor)</small></em>
                    </div>
                     <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::date('licenseExpire', $data['equipo'][0]->licenseExpire, ['class' => 'form-control text-uppercase', 'id' => 'licenseExpire', 'disabled' => 'disabled']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Vencimiento Licencia)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('habilitado', 'Estado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div id="losEstados" class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default @if($data['equipo'][0]->isActive){{ 'active' }} @endif">
                                {{ Form::radio('habilitado', 1, $data['equipo'][0]->isActive, ['name' => 'habilitado', 'id' => 'esHabilitado']) }}
                                <b class="hidden-sm hidden-xs">Habilitado</b>
                                <b class="hidden-md hidden-lg">H</b>
                            </label>
                            <label class="btn btn-default @if(!$data['equipo'][0]->isActive){{ 'active' }} @endif">
                                {{ Form::radio('habilitado', 0, !$data['equipo'][0]->isActive, ['name' => 'habilitado', 'id' => 'esDeshabilitado']) }}
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