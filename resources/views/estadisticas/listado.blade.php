<div class="panel" id="printElement">
    <div class="panel-heading bg-red">
        <h3 class="panel-title">Estadisticas</h3>
    </div>
    <div class="panel-body">
		<!--	LOS TABs 	-->
        <div class="bg-info">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#grafica001" aria-controls="grafica001" role="tab" data-toggle="tab">Salidas</a></li>
                <li role="presentation"><a href="#grafica002" aria-controls="grafica002" role="tab" data-toggle="tab">Expediciones</a></li>
                <li role="presentation"><a href="#grafica003" aria-controls="grafica003" role="tab" data-toggle="tab">Multas</a></li>
                <li role="presentation"><a href="#editAyuda" aria-controls="editAyuda" role="tab" data-toggle="tab">Ayuda</a></li>
            </ul>
        </div>

        <!--	CONTENIDO de los TABs	-->
        <div class="tab-content">
        	<!-- PANEL 001 -->
            <div role="tabpanel" class="tab-pane fade active in" id="grafica001">
                <div id="servicios_diario" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
            </div>

            <!-- PANEL 002 -->
            <div role="tabpanel" class="tab-pane fade" id="grafica002">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingIDA">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#divIDA" aria-expanded="true" aria-controls="divIDA">
                          IDA
                        </a>
                      </h4>
                    </div>
                    <div id="divIDA" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingIDA">
                      <div class="panel-body">
                        <div id="expediciones_ida" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingREG">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#divREG" aria-expanded="false" aria-controls="divREG">
                          REG
                        </a>
                      </h4>
                    </div>
                    <div id="divREG" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingREG">
                      <div class="panel-body">
                        <div id="expediciones_reg" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
                      </div>
                    </div>
                  </div>                
                </div>

            </div>

			<!-- PANEL 003 -->
            <div role="tabpanel" class="tab-pane fade" id="grafica003">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#divDIARIA" aria-expanded="false" aria-controls="divDIARIA">
                          DIARIAS
                        </a>
                      </h4>
                    </div>
                    <div id="divDIARIA" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <div id="multas_diarias" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#divMOVILES" aria-expanded="false" aria-controls="divMOVILES">
                          MOVILES
                        </a>
                      </h4>
                    </div>
                    <div id="divMOVILES" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        <div id="multas_moviles" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
                      </div>
                    </div>
                  </div>                
                </div>
                
            </div>

            <!-- PANEL 004 -->
            <div role="tabpanel" class="tab-pane fade" id="editAyuda">
            	@include('formularios.frmAyuda')
			</div>
        </div>
	</div>
</div>