<div class="panel panel-green">
  <div class="panel-heading text-center" role="tab" id="head{{$movil->pate_movil}}">
    <h1 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#lstFlota" href="#info{{$movil->pate_movil}}" aria-expanded="false" aria-controls="info{{$movil->pate_movil}}">
        Movil: {{ $movil->nume_movil }} - Patente: {{ $movil->pate_movil }}
      </a>
    </h1>
  </div>

  <div style="height:300px; overflow-y:scroll;" id="info{{$movil->pate_movil}}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="head{{$movil->pate_movil}}">
    <table class="table table-striped table-hover table-condensed" id="">
      <thead>
        <tr class="success">
          <th class="text-center">Fecha</th>
          <th class="text-center">1°</th>
          <th class="text-center">2°</th>
          <th class="text-center">3°</th>
          <th class="text-center">4°</th>
          <th class="text-center">5°</th>
          <th class="text-center">6°</th>
        </tr>
      </thead>

      <tbody class="table-responsive" id="">
          <?php $dia_actual = 0;?>
          @foreach($movil->misServicios as $obj)
            @if($dia_actual != $obj['dia'])
              <tr>
              <td class="success text-nowrap"><b>{{ date('d-m-Y', strtotime($obj['inic_servi'])) }}<b></td>
              <?php $dia_actual = $obj['dia'];?>
            @endif
            @if($dia_actual == $obj['dia'])
              <td class="text-center">
                <a href="#!" class="btn btn-md btn-default" data-toggle="tooltip"  data-placement="bottom" title="Conductor: {{ $obj['conductor'] }} (COD: {{ $obj['docu_perso'] }})">
                  {{ date('H:i', strtotime($obj['inic_servi'])) }}  
                </a>
              </td>
            @else
              </tr>
            @endif
            
          @endforeach
      </tbody>

      <tfoot>
        <th class="info text-center" colspan="7">
          FIN DEL LISTADO
        </th>
      </tfoot>
      
    </table>
  </div>

</div>