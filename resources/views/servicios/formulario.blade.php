<div class="row">
  <div class="form-inline pull-right">
    <div class="form-group">
      {{ Form::date('fech_servi', \Carbon\Carbon::now(), ['class' => 'form-control text-uppercase', 'id' => 'fech_servi']) }}
    </div>
    <div class="form-group">
      {{ Form::select('codi_circu', 
              $data['lstCircuitos'], 
              null, ['class' => 'form-control text-uppercase', 'id' => 'codi_circu', 'placeholder' => 'Seleccionar']) 
      }}
      {{ Form::text('copi_numer', null, ['class' => 'form-control text-uppercase', 'id' => 'copi_numer', 'readonly']) }}
    </div>
    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_salidas" disabled="disabled" id="btnAgregar"> 
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Agregar
    </button>

    <button type="button" class="btn btn-info"  id="btnAnalizar">
      <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> Analizar
    </button>
  </div>
</div>