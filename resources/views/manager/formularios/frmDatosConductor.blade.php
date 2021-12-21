<div class="panel panel-default">
    <div class="panel-body form-panel">
    
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                <div class="form-group">
                    {{ Form::label('codi_licen', 'Codigo', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::text('codi_licen', null, ['class' => 'form-control text-uppercase', 'id' => 'codi_licen', 'maxlength' => '8', 'placeholder' => 'COD LICENCIA']) }}
                        <em id="helpBlock" class="help-block hidden-sm hidden-xs"><small>(Este Codigo Corresponde al N° de Licencia)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('lice_condu', 'T. Licencia', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="btn-group btn-group-justified btn-group-md" data-toggle="buttons">
                            <label class="btn btn-default" id="btnA1">A1
                                {{ Form::checkbox('A1', null, null, array('id' => 'A1')) }}
                            </label>
                            <label class="btn btn-default" id="btnA2">A2
                                {{ Form::checkbox('A2', null, null, array('id' => 'A2')) }}
                            </label>
                            <label class="btn btn-default" id="btnA3">A3
                                {{ Form::checkbox('A3', null, null, array('id' => 'A3')) }}
                            </label>
                            <label class="btn btn-default" id="btnA4">A4
                                {{ Form::checkbox('A4', null, null, array('id' => 'A4')) }}
                            </label>
                            <label class="btn btn-default" id="btnA5">A5
                                {{ Form::checkbox('A5', null, null, array('id' => 'A5')) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2 col-lg-offset-2">
                        <div class="btn-group btn-group-justified btn-group-md" data-toggle="buttons">
                            <label class="btn btn-default" id="btnB">B
                                {{ Form::checkbox('B', null, null, array('id' => 'B')) }}
                            </label>
                            <label class="btn btn-default" id="btnC">C
                                {{ Form::checkbox('C', null, null, array('id' => 'C')) }}
                            </label>
                            <label class="btn btn-default" id="btnD">D
                                {{ Form::checkbox('D', null, null, array('id' => 'D')) }}
                            </label>
                            <label class="btn btn-default" id="btnE">E
                                {{ Form::checkbox('E', null, null, array('id' => 'E')) }}
                            </label>
                            <label class="btn btn-default" id="btnF">F
                                {{ Form::checkbox('F', null, null, array('id' => 'F')) }}
                            </label>
                        </div>
                        <em class="help-block hidden-sm hidden-xs" id="helpBlock"><small>(Seleccionar Todas las Clases Obtenidas)</small></em>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('fech_venci', 'F. Venci', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {{ Form::date('fech_venci', null, ['class' => 'form-control text-uppercase', 'id' => 'fech_venci']) }}
                        <em class="help-block hidden-sm hidden-xs" id="helpBlock"><small>(Fecha de Vencimiento)</small></em>
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
                
            </div>
        </div>

    </div>
</div>