<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Consultas</h3>
    </div>
    
    <div class="panel-body">
      <div class="form">  
        {!! Form::open(['method' => 'GET', 'id' => 'frmConsultar']) !!}
          <div class="form-group">
            {{ Form::date('fech_servi', \Carbon\Carbon::now(), ['class' => 'form-control text-uppercase', 'id' => 'fech_servi']) }}
          </div>
    
          <div class="form-group">
            {{ Form::select('codi_circu', 
            $data['lstCircuitos'], 
            null, ['class' => 'form-control text-uppercase', 'id' => 'codi_circu', 'placeholder' => 'Seleccionar']) 
            }}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
    
    <div class="panel-footer">      
      <button type="button" class="btn btn-success btn-block" id="btnConsultar"> 
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar
      </button>
    </div>
</div>