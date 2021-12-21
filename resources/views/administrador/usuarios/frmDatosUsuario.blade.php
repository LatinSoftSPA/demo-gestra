<div class="panel panel-default">
	<div class="panel-body form-panel">
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="form-group">
                    {{ Form::label('codi_usuar', 'Codigo', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    	{{ Form::text('codi_usuar', null, ['class' => 'form-control text-uppercase', 'id' => 'codi_usuar', 'maxlength' => '8', 'placeholder' => 'Codigo', 'disabled' => '', 'readonly' => 'readonly']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Codigo Corresponde al N° de Documento)</small></em>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('pass_usuar', 'Contraseña', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    	{{ Form::password('pass_usuar', ['class' => 'form-control text-uppercase', 'id' => 'pass_usuar', 'maxlength' => '15', 'placeholder' => 'Contraseña', 'disabled' => '']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(El Maximo de Caracteres Permitidos es de 15)</small></em>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('tipo_usuar', 'Tipo', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::select('tipo_usuar', 
                    		[
                    			'1' => 'Administrador', 
                    			'2' => 'Supervisor', 
                    			'3' => 'Dirigente', 
                    			'4' => 'Tecnico', 
                    			'5' => 'Inspector', 
                    			'6' => 'Invitado'
                    		], 
                    		null, ['class' => 'form-control text-uppercase', 'id' => 'tipo_usuar', 'disabled' => '', 'placeholder' => 'Seleccionar Tipo']) 
                    	}}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Grupo de Usuario al que va a pertenecer este Usuario)</small></em>
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('losEstados', 'Estado', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div id="losEstados" class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default" id="btnHabilitado">
                                <input type="radio" name="estadoUsuario" id="esHabilitado" onkeyup="return esEnter(this, event);" value="1" disabled="">
                                    <b class="hidden-sm hidden-xs">Habilitado</b>
                                    <b class="hidden-md hidden-lg">H</b>
                            </label>	
                            <label class="btn btn-default" id="btnDeshabilitado">
                                <input type="radio" name="estadoUsuario" id="esDeshabilitado" onkeyup="return esEnter(this, event);" value="0" disabled="disabled">
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