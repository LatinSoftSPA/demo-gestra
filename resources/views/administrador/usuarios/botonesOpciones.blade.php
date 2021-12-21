<!-- 	Inicio:	Botones de Opciones 	-->
<div class="panel panel-primary">
	<div class="panel-heading">
        <h1 class="panel-title">Opciones</h1>
    </div>
    <div class="panel-body">
    	<div class="form-group" id="formOpciones">
            <a id="btnGUARDAR_USUARIO" href="{{ route('usuarios.store') }}" class="btn btn-block btn-success">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
            </a>
            <button id="btnNuevo" class="btn btn-block btn-" type="button">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
            </button>
            <button id="btnGuardar" class="btn btn-block btn-success hide" type="button">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Guardar
            </button>
            <button id="btnListar" class="btn btn-block btn-warning" type="button" data-toggle="modal" data-target="#modalListaPersonas">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Listar
            </button>
            <button id="btnModificar" class="btn btn-block btn-info" type="button" disabled="">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar
            </button>
            <button id="btnCancelar" class="btn btn-block btn-danger" type="button" disabled="">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
            </button>
        </div>
    </div>
</div>
<!-- 	Fin:	Botones de Opciones 	-->