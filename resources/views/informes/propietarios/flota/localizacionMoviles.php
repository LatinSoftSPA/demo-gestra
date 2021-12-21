<?php foreach ($losMoviles as &$valor) { 
		echo '<button type="button" class="btn btn-danger" onClick="iniciarProceso(this.value)" value="' .$valor['codi_equip']. '">';
echo '<span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Maq'. $valor['nume_movil'];
		echo '</button>';
	}
?>
<div id="divGMap" style="position: relative; width: 100%; height: 400px"></div>