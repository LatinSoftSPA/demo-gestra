<ul class="nav nav-pills nav-justified">
	<li class="active"><a href="#tabMultasDiarias" data-toggle="pill">Multas Diarias</a></li>
	<li><a href="#tabCuotasDiarias" data-toggle="pill">Cuotas Diarias</a></li>
	<li><a href="#tabGraficoComparativo" data-toggle="pill">Comparativa</a></li>
</ul>

<!--	CONTENIDO de los TABs	-->
<div class="tab-content">
	<!-- PANEL 001 -->
	<div role="tabpanel" class="tab-pane fade in active" id="tabMultasDiarias">
		<div class="panel">
			<div class="panel-heading bg-blue">
				<h1 class="panel-title">Multas Diarias</h1>
			</div>
			<div class="panel-body">
				<div id="grafico_multas" style="width: auto; min-width: 300px; height: 300px; margin: 0 auto"></div>
			</div>
			<div class="panel-footer">
				<button type="button" class="btn btn-success btn-block" id="btnImprimirRecaudacionMultas"> 
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Informe
				</button>
			</div>
		</div>
	</div>

	<!-- PANEL 002 -->
	<div role="tabpanel" class="tab-pane fade" id="tabCuotasDiarias">
		<div class="panel">
			<div class="panel-heading bg-red">
				<h1 class="panel-title">Cuotas Diarias</h1>
			</div>
			<div class="panel-body">
				<div id="grafico_cuotas" style="width: auto; min-width: 300px; height: 300px; margin: 0 auto"></div>
			</div>
		</div>
	</div>

	<!-- PANEL 003 -->
	<div role="tabpanel" class="tab-pane fade" id="tabGraficoComparativo">
		<div class="panel">
			<div class="panel-heading bg-yellow">
				<h1 class="panel-title">Recaudaciones</h1>
			</div>
			<div class="panel-body">
				<div id="grafico_recaudaciones" style="width: auto; min-width: 300px; height: 300px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</div>