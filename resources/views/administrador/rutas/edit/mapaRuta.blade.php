<div class="panel panel-default">
{{ Form::hidden
    (
        'url_kmz', 
        $data['ruta']->url_kmz, 
        [
            'class' => 'form-control text-uppercase', 
            'id' => 'url_kmz', 
            'disabled' => 'disabled'
        ]
    )
}}
    <div id="divGMap" style="position: relative; width: 100%; height: 380px"></div>
</div>