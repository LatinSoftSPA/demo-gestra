<div class="panel panel-info">    
    <div class="panel-heading">
        <h1 class="panel-title">Listado de Usuarios</h1>
    </div>
    <div style="height:500px;overflow-y:scroll;"><!--ACTIVAMOS EL SCROLL EN DIV CONTENEDOR DE LA TABLA-->
        <table class="table table-responsive table-striped table-condensed table-hover table-bordered">
            <thead>
                <tr class="info">
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Opcion</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Domicilio</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">Movil</th>
                    <th class="text-center">E-Mail</th>
                </tr>
            </thead>
            <tbody id="tablaListadoPersonas">
                @foreach($data['listado'] as $obj)
                    <tr @if ($obj->activo == 1) class="success" @else class="danger" @endif data-idde_objeto="{{ $obj->docu_perso }}">
                        <td class="text-center"><b>{{ $obj->abre_tipo }}</b></td>
                        <td class="text-center">{{ $obj->docu_perso }}</td>
                        <td class="text-center">
                            <a href="{{ route('usuarios.edit', $obj->docu_perso) }}" class="btn btn-xs btn-warning">
                                <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                            </a>
                            <a href="#!" class="btn btn-xs btn-danger btnEliminar">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td class="text-nowrap">{{ $obj->prim_nombr .' '. $obj->segu_nombr}}</td>
                        <td class="text-nowrap">{{ $obj->apel_pater .' '. $obj->apel_mater}}</td>
                        <td class="text-nowrap">{{ $obj->nomb_domic .' #'. $obj->nume_domic}}</td>
                        <td class="text-center">{{ $obj->tele_conta }}</td>
                        <td class="text-center">{{ $obj->movi_conta }}</td>
                        <td class="text-center">{{ $obj->mail_conta }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>