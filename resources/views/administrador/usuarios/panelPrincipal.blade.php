<div class="panel panel-primary">    
    <div class="panel-heading">
        <h1 class="panel-title">Formulario de Registro</h1>
    </div>

    <div class="panel-body">
        <!--	LOS TABs 	-->
        <div>
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#tabFrmPersona" aria-controls="tabFrmPersona" role="tab" data-toggle="tab">Datos Persona</a></li>
                <li role="presentation"><a href="#tabFrmContacto" aria-controls="tabFrmContacto" role="tab" data-toggle="tab">Datos Contacto</a></li>
                <li role="presentation"><a href="#tabFrmUsuario" aria-controls="tabFrmUsuario" role="tab" data-toggle="tab">Datos del Usuario</a></li>
                <li role="presentation"><a href="#tabAyuda" aria-controls="tabAyuda" role="tab" data-toggle="tab">Ayuda</a></li>
            </ul>
        </div>

        <!--	CONTENIDO de los TABs	-->
        <div class="tab-content">
        	<!-- PANEL 001 -->
            <div role="tabpanel" class="tab-pane fade active in" id="tabFrmPersona">
            	@include('formularios.frmDatosPersona')
			</div>

            <!-- PANEL 002 -->
            <div role="tabpanel" class="tab-pane fade" id="tabFrmContacto">
            	@include('formularios.frmDatosContacto')
			</div>

			<!-- PANEL 003 -->
            <div role="tabpanel" class="tab-pane fade" id="tabFrmUsuario">
            	@include('administrador.usuarios.frmDatosUsuario')
			</div>
			<!-- PANEL 004 -->
            <div role="tabpanel" class="tab-pane fade" id="tabAyuda">
            	@include('formularios.frmAyuda')
			</div>
        </div>
    </div>
</div>