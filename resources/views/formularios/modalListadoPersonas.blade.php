<div class="modal fade" id="modalListaPersonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title text-center"><b id="tituloModalDetalle">Listado de Usuarios</b></h6>
            </div>

            <div style="height:500px;overflow-y:scroll;"><!--ACTIVAMOS EL SCROLL EN DIV CONTENEDOR DE LA TABLA-->
                <table class="table table-responsive table-striped table-condensed table-hover table-bordered">
                    <thead>
                        <tr class="info">
                            <th class="text-center">Opcion</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Domicilio</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Movil</th>
                            <th class="text-center">E-Mail</th>
                        </tr>
                    </thead>
                    <tbody id="tablaListadoPersonas">
                        @foreach($listado as $obj)
                            <tr @if ($obj->habilitado == 1) class="success" @else class="danger" @endif data-docu_perso="{{ $obj->docu_perso }}">
                                <td class="text-center">
                                    <a href="#" class="btn btn-xs btn-warning btnEditar">
                                        <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Detallar
                                    </a>
                                </td>
                                <td>{{ $obj->docu_perso }}</td>
                                <td class="text-nowrap">{{ $obj->prim_nombr .' '. $obj->segu_nombr}}</td>
                                <td class="text-nowrap">{{ $obj->apel_pater .' '. $obj->apel_mater}}</td>
                                <td class="text-nowrap">{{ $obj->nomb_domic .' #'. $obj->nume_domic}}</td>
                                <td class="text-center">{{ $obj->tele_conta }}</td>
                                <td class="text-center">{{ $obj->movi_conta }}</td>
                                <td>{{ $obj->mail_conta }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="info">
                            <th class="text-center" colspan="9">
                                FIN DE LA LISTA
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>