@extends('pages/master')



@section('titulo', 'Lista Usuarios')
@section('contenido')
<table class="table table-striped table-condensed table-hover table-bordered">
    <thead>
        <tr class="info">
            <th class="text-center">ID</th>
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
        	<tr>
        		<td>{{ $obj->docu_perso }}</td>
        		<td class="text-center"><a href="#" class="btn btn-xs btn-warning">Edit</a></td>
        		<td>{{ $obj->prim_nombr }}</td>
        		<td>{{ $obj->segu_nombr }}</td>
        		<td>{{ $obj->apel_pater }}</td>
        		<td>{{ $obj->apel_mater }}</td>
        		<td>{{ $obj->fech_nacim }}</td>
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
@endsection