<div class="panel panel-info">    
    <div class="panel-heading">
        <h1 class="panel-title">Detalle de la Ruta</h1>
    </div>

    <div class="panel-body">
        <!--	LOS TABs 	-->
        <div>
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#tabUno" aria-controls="tabUno" role="tab" data-toggle="tab">Trazado de la Ruta</a></li>
                <li role="presentation"><a href="#tabDos" aria-controls="tabDos" role="tab" data-toggle="tab">Puntos de Control</a></li>
                <li role="presentation"><a href="#tabAyuda" aria-controls="tabAyuda" role="tab" data-toggle="tab">Ayuda</a></li>
            </ul>
        </div>

        <!--	CONTENIDO de los TABs	-->
        <div class="tab-content">
        	<!-- PANEL 001 -->
            <div role="tabpanel" class="tab-pane fade active in" id="tabUno">
                @include('administrador.rutas.edit.mapaRuta')
            </div>

            <!-- PANEL 002 -->
            <div role="tabpanel" class="tab-pane fade" id="tabDos">
                @include('administrador.rutas.edit.listado')
            </div>

            <!-- PANEL 003 -->
            <div role="tabpanel" class="tab-pane fade" id="tabAyuda">
            	@include('formularios.frmAyuda')
			</div>
        </div>
    </div>

    <div class="panel-footer">
        <a href="#!" class="btn btn-success btn-block" id="btnEditar">
            <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Guardar
        </a>
    </div>
</div>