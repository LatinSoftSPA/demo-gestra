var objInformeServicio = null;

function _lstHtmlInforme(listado) {
  var elHtml = "";
  var cont = 0;
  var tota_pagar = 0;

  console.log(listado);
  $.each(listado, function(i, obj) {
    //var fech_progr = new Date(obj.fech_progr * 1000);
    //var fechaP = fech_progr.toISOString().slice(0,10);
    //var horaP = fech_progr.toTimeString().slice(0,5);

    var fech_progr = obj.fech_progr;
    var horaP = fech_progr.slice(11, 16);
    var multa = 0;

    var tolerancia = obj.minu_toler;

    if (obj.dife_contro > 0) {
      elHtml += '<tr class="danger">';
    } else {
      elHtml += '<tr class="">';
    }
    cont++;
    elHtml +=
      '<td class="info text-center hidden-sm hidden-xs"><b>' +
      cont +
      "</b></td>";
    elHtml +=
      '<td class="info text-nowrap hidden-sm hidden-xs">' +
      obj.nomb_geoce +
      "</td>";
    elHtml +=
      '<td class="info text-center hidden-lg hidden-md">' +
      obj.abre_geoce +
      "</td>";
    elHtml += '<td class="info text-center"><b>' + horaP + "</b></td>";

    if (obj.procesado == 0) {
      elHtml += '<td class="text-center"><b>--:--</b></td>';
      elHtml += '<td class="text-center">--</td>';
      elHtml += '<td class="text-center">---</td>';
      elHtml += '<td class="text-center">----------</td>';
    } else {
      //var fech_contr = new Date(obj.fech_contr * 1000);
      //var fechaC = fech_contr.toISOString().slice(0,10);
      //var horaC = fech_contr.toTimeString().slice(0,5);

      var fech_contr = obj.fech_contr;

      if (fech_contr != null) {
        var horaC = fech_contr.slice(11, 16);
      } else {
        var horaC = "--:--";
      }

      elHtml += '<td class="text-center"><b>' + horaC + "</b></td>";
      //minutos = Math.floor((obj.fech_contr - obj.fech_progr)/59);
      elHtml += '<td class="text-center">' + obj.minu_toler + "</td>";
      elHtml += '<td class="text-center">' + obj.dife_contro + "</td>";
      elHtml +=
        '<td class="text-center"><b>' +
        obj.velo_contr +
        "<b><small> km/hr</small></td>";
    }
    if (obj.tota_multa > 0) {
      elHtml += '<td class="text-center">' + obj.tota_multa + "</td>";
    } else {
      elHtml += '<td class="text-center">---</td>';
    }

    elHtml += "</td>";

    elHtml += "</tr>";
    tota_pagar = tota_pagar + multa;
  });

  return elHtml;
}

$(document).ready(function() {
  $(".btnImprimirInforme").click(function() {
    var mi_servicio = objInformeServicio.mi_servicio.servicio;
    imprimirInforme(
      mi_servicio["codi_circu"],
      mi_servicio["nume_movil"],
      mi_servicio["pate_movil"],
      mi_servicio["codi_servi"],
    );
    $("#modal_informe").modal("hide");
  });
});

function imprimirInforme(codi_circu, nume_movil, pate_movil, codi_servi) {
  var url = "informes/imprimir";

  var parametros = {
    codi_circu: codi_circu,
    nume_movil: nume_movil,
    pate_movil: pate_movil,
    codi_servi: codi_servi,
  };
  var token = document.getElementsByName("_token");
  $.ajax({
    url: url,
    headers: { "X-CSRF-TOKEN": token[0].value },
    type: "POST",
    data: parametros,
    beforeSend: function() {},
    success: function() {},
    error: function() {
      mostrarMensaje("ALGO SALIO MAL AL IMPRIMIR", "alert-danger");
    },
  });
}
function imprimirInformeOLD(
  mi_servicio,
  mis_controladas,
  tu_servicio,
  tus_controladas,
) {
  var url = "informe/imprimir";

  var parametros = {
    mi_servicio: mi_servicio,
    mis_controladas: mis_controladas,
    tu_servicio: tu_servicio,
    tus_controladas: tus_controladas,
  };

  var token = document.getElementsByName("_token");
  $.ajax({
    url: url,
    headers: { "X-CSRF-TOKEN": token[0].value },
    type: "POST",
    data: parametros,
    beforeSend: function() {},
    error: function() {
      mostrarMensaje("ALGO SALIO MAL AL IMPRIMIR", "alert-danger");
    },
  });
}
