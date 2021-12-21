<div class="form-inline pull-right">
  <div class="form-group">
    {{ Form::date('fech_consu', \Carbon\Carbon::now(), ['class' => 'form-control text-uppercase', 'id' => 'fech_consu']) }}
  </div>
  <div class="form-group">
    {{ Form::select('codi_circu', 
            $data['lstCircuitos'], 
            null, ['class' => 'form-control text-uppercase', 'id' => 'codi_circu', 'placeholder' => 'Seleccionar']) 
    }}
  </div>
  
  <button type="button" class="btn btn-success" id="btnConsultar"> 
    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar
  </button>
</div>