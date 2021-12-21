var objMulta = null;

var total_infor = null;
var total_pagar = null;
var total_descu = null;

$(document).ready(function(){
  $('#modal_multa').on('shown.bs.modal', function(){
    _cargarCampos();      
    $('#pagar_ida').focus();
    $('#pagar_ida').select();
  });

  $('#modal_multa').on('hidden.bs.modal', function(){
    objMulta = null;
    $('#total_ida').val(0);
    $('#pagar_ida').val(0);
    $('#total_regre').val(0);
    $('#pagar_regre').val(0);
    $('#desc_total').val(0);
    $('#tota_pagar').val(0);
    $('#nota_multa').val('');
  });
});

$(document).ready(function(){
  $('#pagar_ida').keypress(function(e){
    if(e.which == 13){
      calcularTotales();
      $('#pagar_regre').focus();
      $('#pagar_regre').select();
    }
  });
});

$(document).ready(function(){
  $('#pagar_regre').keypress(function(e){
    if(e.which == 13){
      calcularTotales();
      $('#nota_multa').focus();
      $('#nota_multa').select();
    }
  });
});

$(document).ready(function(){
  $('#nota_multa').keypress(function(e){
    if(e.which == 13){
      $('#btnPagar').focus();
    }
  });
});
/*###################################################################################################*/
$(document).ready(function(){
	$('#btnPagar').click(function(e){
		$('#modal_multa').modal('hide');
		e.preventDefault();
		_calcularTotales();
		var servicio = objMulta.mi_servicio.servicio;
		var expediciones = objMulta.mi_servicio.expediciones;
		var multas = objMulta.mi_servicio.multas;

		//multas[0].pagada = true;
		//multas[1].pagada = true;
		var nota = $('#nota_multa').val();
		var cobro = _cobraMulta(servicio, expediciones, multas, nota);
		cobro.done(function(data, textStatus, jqXHR){
			listarServicios();
		});
	});
});

function _cargarCampos(){
  if(objMulta != null){
    var servicio = objMulta.mi_servicio.servicio;
    var fech_servi = new Date(servicio.codi_servi * 1000);
    var hora_servi = fech_servi.toTimeString().slice(0,5);          //LINUX
    //var hora_servi = fech_servi.toLocaleTimeString().slice(0,5);    //WINDOWS

    $('#hora_serv2').val(hora_servi);
    $('#codi_servi').val(servicio.codi_servi);
    $('#nume_maqui').val(servicio.nume_movil);
    $('#pate_maqui').val(servicio.pate_movil);

    $('#nomb_condu').val(servicio.conductor);
    $('#docu_condu2').val(servicio.docu_perso);

    var total = 0;
    var las_multas = objMulta.mi_servicio.multas;

    $.each(las_multas, function(i, multa){
      console.dir(multa);
  		multado 	= 0;
  		pagada 	= 0;
  		total 	+= parseInt(multa.tota_multa);
  		if (typeof multa !== "undefined"){
  		  multado 	= parseInt(multa.tota_multa);
  		  pagada 	= parseInt(multa.pagada);
  		}
  		if (typeof multa !== "undefined"){
  		  if(multa.codi_senti == 0){
  			$('#total_ida').val(multado);
  			$('#pagar_ida').val(multado);
  		  }
  		  if(multa.codi_senti == 1){
  			$('#total_regre').val(multado);
  			$('#pagar_regre').val(multado);
  		  }
  		}
    });
    $('#tota_pagar').val(total);
  }
}

function _calcularTotales(){
  var multas = objMulta.mi_servicio.multas;
  total_infor = 0;
  total_pagar = 0;
  total_descu = 0;
  $.each(multas, function(i, multa){
    total_infor+= multa.tota_multa;

    if(multa.codi_senti == 0){
      total_pagar += parseInt($('#pagar_ida').val());
      objMulta.mi_servicio.multas[i].tota_pagad = parseInt($('#pagar_ida').val());
    }
    if(multa.codi_senti == 1){
      total_pagar += parseInt($('#pagar_regre').val());
      objMulta.mi_servicio.multas[i].tota_pagad = parseInt($('#pagar_regre').val());
    }
  });
  
  //multas[0].tota_pagad = parseInt($('#pagar_ida').val());
  //multas[1].tota_pagad = parseInt($('#pagar_regre').val());
  total_descu = parseInt(total_infor) - parseInt(total_pagar);
  $('#desc_total').val(total_descu);  
  $('#tota_pagar').val(total_pagar);
}

function _cobraMulta(servicio, expediciones, multas, nota){
	var url = 'servicios/cobrar/multa';
	var token = document.getElementsByName("_token");

	var parametros = {'servicio' : servicio, 'expediciones' : expediciones, 'multas' : multas, 'nota' : nota};

	return $.ajax({
		url: url,
		headers : {'X-CSRF-TOKEN' : token[0].value},
		type: 'POST',
		data: parametros,
		dataType: 'json',
		beforeSend: function(){}
	})
	.done(function(data, textStatus, jqXHR ){
		var title = 'Felicidades';
		toastr.success(data.msg, title);
	})
	.always(function( a, textStatus, b ) {
	//TODO
	})
	.fail(function( jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 404) {
			console.log(jqXHR.responseText);
		}
	});
}
