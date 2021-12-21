<div class="panel panel-default">
    <div class="panel-body form-panel">
    
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                <div class="form-group">
                    {{ Form::label('accountID', 'Asociado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('accountID', null, ['class' => 'form-control text-uppercase', 'id' => 'accountID', 'placeholder' => 'lineas-iqq']) }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('groupID', null, ['class' => 'form-control text-uppercase', 'id' => 'groupID', 'placeholder' => 'linea-104-iqq']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('driverID', 'Coductor', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('driverID', null, ['class' => 'form-control text-uppercase', 'id' => 'driverID', 'placeholder' => 'CODIGO CONDUCTOR']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Codigo Conductor)</small></em>
                    </div>
                     <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::date('licenseExpire', null, ['class' => 'form-control text-uppercase', 'id' => 'licenseExpire']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Vencimiento Licencia)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Labels', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('description', null, ['class' => 'form-control text-uppercase', 'id' => 'description', 'placeholder' => 'LABEL MAPA']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Label Se Reflejara en los Mapas)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('displayName', null, ['class' => 'form-control text-uppercase', 'id' => 'displayName', 'placeholder' => 'LABEL BURBUJAS']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Label Se Reflejara en las Burbujas)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('licensePlate', 'Patente', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('licensePlate', null, ['class' => 'form-control text-uppercase', 'id' => 'licensePlate', 'placeholder' => 'PLACA PATENTE']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Placa Patente del Movil)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('vehicleYear', null, ['class' => 'form-control text-uppercase', 'id' => 'vehicleYear', 'placeholder' => 'AÑO MOVIL']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Año del Movil)</small></em>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>