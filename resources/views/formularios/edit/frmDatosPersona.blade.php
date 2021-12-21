<div class="panel panel-default">
	<div class="panel-body form-panel">
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="form-group">
                	{{ Form::label('docu_perso', 'N° Docum', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    	{{ Form::text('docu_perso', $obj->docu_perso, ['class' => 'form-control text-uppercase', 'id' => 'docu_perso', 'maxlength' => '8', 'required' => 'required', 'placeholder' => 'Ej. 87654321']) }}
                    </div>
                </div>

                <div class="form-group">
                	{{ Form::label('prim_nombr', 'Nombres', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    	{{ Form::text('prim_nombr', $obj->prim_nombr, ['class' => 'form-control text-uppercase', 'id' => 'prim_nombr', 'maxlength' => '15', 'required' => 'required', 'placeholder' => 'Primer Nombre']) }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        {{ Form::text('segu_nombr', $obj->segu_nombr, ['class' => 'form-control text-uppercase', 'id' => 'segu_nombr', 'maxlength' => '15', 'placeholder' => 'Segundo Nombre']) }}
                    </div>
                </div>

                <div class="form-group">
                	{{ Form::label('apel_pater', 'Apellidos', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    	{{ Form::text('apel_pater', $obj->apel_pater, ['class' => 'form-control text-uppercase', 'id' => 'apel_pater', 'maxlength' => '15', 'required' => 'required', 'placeholder' => 'Apellido Paterno']) }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    	{{ Form::text('apel_mater', $obj->apel_mater, ['class' => 'form-control text-uppercase', 'id' => 'apel_mater', 'maxlength' => '15', 'required' => 'required', 'placeholder' => 'Apellido Materno']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('idde_gener', 'Genero', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div id="losEstados" class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default @if($obj->idde_gener){{ 'active' }} @endif" id="btnHabilitado">
                                {{ Form::radio('idde_gener', 1, $obj->idde_gener, ['name' => 'idde_gener', 'id' => 'esHabilitado']) }}
                                <b class="hidden-sm hidden-xs">Masculino</b>
                                <b class="hidden-md hidden-lg">M</b>
                            </label>
                            <label class="btn btn-default @if(!$obj->idde_gener){{ 'active' }} @endif" id="btnDeshabilitado">
                                {{ Form::radio('idde_gener', 0, !$obj->idde_gener, ['name' => 'idde_gener', 'id' => 'esDeshabilitado']) }}
                                <b class="hidden-sm hidden-xs">Femenino</b>
                                <b class="hidden-md hidden-lg">F</b>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('fech_nacim', 'F. Nacim', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    	{{ Form::date('fech_nacim', $obj->fech_nacim, ['class' => 'form-control text-uppercase', 'id' => 'fech_nacim']) }}
                        <em class="help-block hidden-md hidden-lg" id="helpBlock"><small>(Fecha de Nacimiento)</small></em>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    	{{ Form::select('idde_nacio', 
                            $data['lstNacionalidades'], 
                            $obj->idde_nacio, ['class' => 'form-control text-uppercase', 'id' => 'idde_nacio', 'placeholder' => 'Seleccionar']) 
                        }}
                    </div>
                </div>

                <div class="form-group">
                	{{ Form::label('idde_ecivi', 'E. Civil', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                       	{{ Form::select('idde_ecivi', 
                            $data['lstECiviles'], 
                            $obj->idde_ecivi, ['class' => 'form-control text-uppercase', 'id' => 'idde_ecivi', 'placeholder' => 'Seleccionar']) 
                        }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="thumbnail">
                    <img src="{{{ asset('img/user.png') }}}" class="img-responsive img-rounded">
                    <button id="btnTomarFoto" class="btn btn-block btn-success" type="button">
                        <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Tomar Foto
                    </button>
                    <button id="btnSubirFoto" class="btn btn-block btn-warning" type="button">
                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Subir Foto
                    </button>
                </div>
            </div>

        </div>
	</div>
</div>