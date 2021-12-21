<div class="form-group">
    {{ Form::label('tele_conta', 'Telefono', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {{ Form::number('tele_conta', $obj->tele_conta, ['class' => 'form-control text-uppercase', 'id' => 'tele_conta', 'max' => '9999999', 'placeholder' => 'Telefono']) }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {{ Form::number('movi_conta', $obj->movi_conta, ['class' => 'form-control text-uppercase', 'id' => 'movi_conta', 'max' => '999999999', 'placeholder' => 'Celular']) }}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('mail_conta', 'E-Mail', ['class' => 'col-md-2 col-lg-2 hidden-sm hidden-xs control-label']) }}
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
        {{ Form::text('mail_conta', $obj->mail_conta, ['class' => 'form-control text-uppercase', 'id' => 'mail_conta', 'maxlength' => '50', 'placeholder' => 'correo@latinsoft.cl']) }}
    </div>
</div>