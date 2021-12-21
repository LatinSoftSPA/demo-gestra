<div class="panel panel-primary">    
    <div class="panel-heading">
        <h1 class="panel-title">Listado de Empresas</h1>
    </div>
    
    <div style="height:500px;overflow-y:scroll;"><!--ACTIVAMOS EL SCROLL EN DIV CONTENEDOR DE LA TABLA-->
        <table class="table table-responsive table-striped table-condensed table-hover table-bordered">
            <thead>
                <tr class="info">
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Opcion</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Domicilio</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">E-Mail</th>
                </tr>
            </thead>
            <tbody id="tablaListadoPersonas">
                @foreach($listado as $obj)
                    <tr @if ($obj->habilitado === 1) class="success" @else class="danger" @endif data-idde_objeto="{{ $obj->docu_empre }}">
                        <td class="text-center">{{ $obj->docu_empre }}</td>
                        <td class="text-center">
                            <a href="{{ route('empresas.edit', $obj->docu_empre) }}" class="btn btn-xs btn-warning">
                                <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                            </a>
                            <a href="#!" class="btn btn-xs btn-danger btnEliminar">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td class="text-nowrap">{{ $obj->nomb_empre}}</td>
                        <td class="text-nowrap">{{ $obj->domi_empre}}</td>
                        <td class="text-nowrap">{{ $obj->tele_movil}}</td>
                        <td class="text-center">{{ $obj->mail_empre}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! Form::open(['route' => ['conductores.destroy', ':IDDE_OBJET'], 'method' => 'DELETE', 'id' => 'frmEliminar']) !!}
        {!! Form::close() !!}
    </div>
    <div class="panel-footer text-center">
        {!! $listado->render()!!}
    </div>
</div>