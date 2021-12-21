<div class="media">

	<div class="media-left media-top">
		<img src="../../../../img/avatar2.png" class="media-object" style="width:60px">
	</div>
	<div class="media-body">
	@foreach($tuServicio as $obj)
		<b>Servicio: </b>{{ date('H:i', strtotime('-0 hours', $obj->inic_servi)) }}
		</br>
		<b>Fecha: </b>{{ date('d-m-Y', strtotime('-0 hours', $obj->inic_servi)) }}
		</br>
		<b>Circuito: </b>{{ $obj->codi_circu }}
		</br>
		<b>Movil N°: </b>{{ $obj->nume_movil }}
		</br>
		<b>Patente: </b>{{ $obj->pate_movil }}
		</br>
		<b>Conductor: </b>{{ $obj->conductor }}
		</br>
		<b>Codigo: </b>{{ $obj->docu_perso }}
		</br>
		<b>Licencia N°: </b>{{ $obj->docu_perso }}
	@endforeach
	</div>
</div>

<div class="table-responsive" style="height:650px; overflow-y:scroll;">
	<table class="table table-striped table-hover table-condensed" id="tblListadoServicios">
		<thead>
			<tr class="danger">
				<th class="text-center hidden-sm hidden-xs">Punto de Control</th>
				<th class="text-center hidden-md hidden-lg">Control</th>
				<th class="text-center">Progr</th>
				<th class="text-center">Contr</th>
				<th class="text-center">Toler</th>
				<th class="text-center">Difer</th>
				<th class="text-center">Multa $</th>
			</tr>
		</thead>
		<tbody id="listadoControles">
			@foreach($tusProgramadas as $obj)
				<tr>
					<td class="hidden-sm hidden-xs"><b> {{ $obj->nomb_geoce }} </b></td>
					<td class="hidden-md hidden-lg"><b> {{ $obj->abre_geoce }} </b></td>
					<td class="text-center">{{ date('H:i', strtotime('-0 hours', $obj->fech_progr)) }}</td>
					@if($obj->fech_contr == "")
						<td class="text-center">--:--</td>
					@else
						<td class="text-center">{{ date('H:i', strtotime('-0 hours', $obj->fech_contr)) }}</td>				
					@endif
					@if($obj->minu_toler == 99)
						<td class="text-center">{{ $obj->minu_toler }}</td>
						<td class="text-center">---</td>
					@else
						<td class="text-center">---</td>
						<td class="text-center">{{ $obj->dife_contro }}</td>
					@endif
					
					
					<td class="text-center">{{ $obj->tota_multa }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>