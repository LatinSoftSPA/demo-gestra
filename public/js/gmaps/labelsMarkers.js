var lstLabels = [];

function definirLabelMarker(elMapa, marker)
{
      console.dir(marker.title);
    var label = new Label();
    label.bindTo('position', marker);
    label.bindTo('text', marker, 'title');
    label.bindTo('visible', marker);
    label.bindTo('zIndex', marker);
    
    return label;
}

function agregarLabelMarker(){
    var listado = lstLabels;
    $.each(lstTrackers, function(i, tracker){
      listado[tracker].setMap(elMapa);
    });
} 

function limpiarLabelMarker(){
  var listado = lstLabels;
  $.each(lstTrackers, function(i, tracker){
    listado[tracker].setMap(null);
  });
}

// Define the overlay, derived from google.maps.OverlayView
function Label(opt_options){
    this.setValues(opt_options);

    var span = this.span_ = document.createElement('span');
    span.style.cssText = 'position: relative;'+
                        'left: -22%;top: 12px; ' +
                        'padding: 1px 3px;white-space: nowrap;color: #ffff00;' +
                        //'background-color: rgba(111,111,111,0.3);'+
                        'text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;';

    var div = this.div_ = document.createElement('div');
    div.appendChild(span);
    div.style.cssText = 'position: absolute; display: none; '+
                        'font-weight: bold; font-size: 12px;'+
                        'z-index:9999;';
};
Label.prototype = new google.maps.OverlayView;

Label.prototype.onAdd = function(){
    var pane = this.getPanes().overlayLayer;
    pane.appendChild(this.div_);
    var me = this;
    this.listeners_ = [
        google.maps.event.addListener(this, 'position_changed', function(){ me.draw();}),
        google.maps.event.addListener(this, 'text_changed', function(){ me.draw();})
    ];
};

Label.prototype.onRemove = function(){
    this.div_.parentNode.removeChild(this.div_);
    for (var i = 0, I = this.listeners_.length; i < I; ++i){
        google.maps.event.removeListener(this.listeners_[i]);
    }
};

Label.prototype.draw = function(){
    var projection = this.getProjection();
    var position = projection.fromLatLngToDivPixel(this.get('position'));
    var div = this.div_;
    div.style.left = position.x + 'px';
    div.style.top = position.y + 'px';
    div.style.display = 'block';
    this.span_.innerHTML = this.get('text').toString();
};