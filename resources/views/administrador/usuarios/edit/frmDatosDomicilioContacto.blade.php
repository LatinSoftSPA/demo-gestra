<div class="panel panel-default">
    <div class="panel-body form-panel">
        <div class="form-horizontal">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                @foreach($objDomicilio as $obj)
                    @include('usuarios.edit.frmDomicilio')
                @endforeach
                    
                @foreach($objContacto as $obj)                    
                    @include('usuarios.edit.frmContacto')
                @endforeach
            </div>
        </div>
    </div>
</div>