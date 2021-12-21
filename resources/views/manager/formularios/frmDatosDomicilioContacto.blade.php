<div class="panel panel-default">
    <div class="panel-body form-panel">
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

            	<div class="form-group">
                    {{ Form::label('nomb_domic', 'Domicilio', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                {{ Form::text('nomb_domic', null, ['class' => 'form-control text-uppercase', 'id' => 'nomb_domic', 'maxlength' => '50', 'placeholder' => 'Domicilio']) }}
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {{ Form::text('nume_domic', null, ['class' => 'form-control text-uppercase', 'id' => 'nume_domic', 'maxlength' => '8', 'placeholder' => 'Numero']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('nomb_pobla', 'Poblacion', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                {{ Form::text('nomb_pobla', null, ['class' => 'form-control text-uppercase', 'id' => 'nomb_pobla', 'maxlength' => '30', 'placeholder' => 'Poblacion']) }}
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {{ Form::number('nume_bloqu', null, ['class' => 'form-control text-uppercase', 'id' => 'nume_bloqu', 'maxlength' => '10', 'placeholder' => 'Block']) }}
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {{ Form::number('nume_depto', null, ['class' => 'form-control text-uppercase', 'id' => 'nume_depto', 'maxlength' => '5', 'placeholder' => 'Depto']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('idde_provi', 'Ciudad', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                {{ Form::select('idde_provi', 
                                    $data['lstProvincias'], 
                                    null, ['class' => 'form-control text-uppercase', 'id' => 'idde_provi', 'placeholder' => 'Seleccionar']) 
                                }}
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    {{ Form::label('tele_conta', 'Telefono', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                {{ Form::number('tele_conta', null, ['class' => 'form-control text-uppercase', 'id' => 'tele_conta', 'max' => '9999999', 'placeholder' => 'Telefono']) }}
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                {{ Form::number('movi_conta', null, ['class' => 'form-control text-uppercase', 'id' => 'movi_conta', 'max' => '999999999', 'placeholder' => 'Celular']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('mail_conta', 'E-Mail', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('mail_conta', null, ['class' => 'form-control text-uppercase', 'id' => 'mail_conta', 'maxlength' => '50', 'placeholder' => 'correo@latinsoft.cl']) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>