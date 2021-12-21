var subtitulo_multas = '';
var subtitulo_ejeY = '';

function _crearGraficoEXP(titulo_grafico, capa_grafico, data, tipo)
{
	var periodos = [];
	var exigidos = [];
	var registrados = [];
	$.each(data, function(i, obj){
		periodos.push(obj.PERIODO);
		exigidos.push(obj.EXIGIDO);
		registrados.push(obj.REGISTRADO);
	});

    Highcharts.chart(capa_grafico, {
        chart     : _confiGrafico(tipo),
        title     : _confiTitulo(titulo_grafico),
        subtitle  : _confiSubTitulo(subtitulo_multas),
        tooltip   : _confiTooltip(),
        legend    : _confiLegend('#E0EF2C'),
        series    : [
            {
                name: 'Exigidos',
                data: exigidos,
                color: '#c4392d',
            },
            {
                name: 'Registrados',
                data: registrados,
                color: '#42DA24',
            }
        ],
        xAxis     : _confiEjeX(periodos),
        yAxis     : _confiEjeY(subtitulo_ejeY),
        plotOptions: _confiPlot(),
        responsive: _confiResponsive(),
        credits: {
                enabled: false
        }
    });
}

function _crearGraficoSER(titulo_grafico, capa_grafico, data, tipo)
{
    var movil = [];
    var total = [];
    $.each(data, function(i, obj){
        movil.push(obj.MOVIL);
        total.push(obj.TOTAL);
    });

    Highcharts.chart(capa_grafico, {
        chart     : _confiGrafico(tipo),
        title     : _confiTitulo(titulo_grafico),
        subtitle  : _confiSubTitulo(subtitulo_multas),
        tooltip   : {
            headerFormat  : '<b>Movil: {point.key}</b><br/>',
            pointFormat   : '<small style=\"color:{series.color}\">{series.name}</small>: <b>{point.y}</b><br/>',
            borderWidth: 5,
            shared: true,
        },
        legend    : _confiLegend('#E0EF2C'),
        series    : [
            {
                name: 'Vueltas',
                data: total,
                color: '#c4392d',
            }
        ],
        xAxis     : _confiEjeX(movil),
        yAxis     : _confiEjeY(subtitulo_ejeY),
        plotOptions: _confiPlot(),
        responsive: _confiResponsive(),
        credits: {
                enabled: false
        }
    });
}

function _crearGraficoMULDIA(titulo_grafico, capa_grafico, data, tipo)
{
    var movil = [];
    var multas = [];
    $.each(data, function(i, obj){
        movil.push(obj.MOVIL);
        multas.push({
            y: parseInt(obj.TOTAL),
            key: obj.MOVIL,
            hora: obj.HORA,
            total: parseInt(obj.TOTAL)
        });
    });

    Highcharts.chart(capa_grafico, {
        chart     : _confiGrafico(tipo),
        title     : _confiTitulo(titulo_grafico),
        subtitle  : _confiSubTitulo(subtitulo_multas),
        tooltip   : {
            headerFormat  : '<b>Movil:</b> {point.key}<br/>',
            pointFormat   : '<b>Servicio: </b>: {point.hora} <br/>'+
                '<small style=\"color:{series.color}\">{series.name}</small>: <b>{point.total}</b><br/>',

            borderWidth: 5,
            shared: true,
        },
        legend    : _confiLegend('#E0EF2C'),
        series    : [
            {
                name: 'Multas',
                data: multas,
                color: '#c4392d',
            }
        ],
        xAxis     : _confiEjeX(movil),
        yAxis     : _confiEjeY(subtitulo_ejeY),
        plotOptions: _confiPlot(),
        responsive: _confiResponsive(),
        credits: {
                enabled: false
        }
    });
}

function _crearGraficoMULMOV(titulo_grafico, capa_grafico, data, tipo)
{
    var movil = [];
    var multas = [];
    $.each(data, function(i, obj){
        movil.push(obj.MOVIL);
        multas.push({
            y: parseInt(obj.TOTAL),
            key: obj.MOVIL,
            hora: obj.HORA,
            total: parseInt(obj.TOTAL)
        });
    });

    Highcharts.chart(capa_grafico, {
        chart     : _confiGrafico(tipo),
        title     : _confiTitulo(titulo_grafico),
        subtitle  : _confiSubTitulo(subtitulo_multas),
        tooltip   : {
            headerFormat  : '<b>Movil:</b> {point.key}<br/>',
            pointFormat   : '<small style=\"color:{series.color}\">{series.name}</small>: <b>{point.total}</b><br/>',

            borderWidth: 5,
            shared: true,
        },
        legend    : _confiLegend('#E0EF2C'),
        series    : [
            {
                name: 'Multas',
                data: multas,
                color: '#c4392d',
            }
        ],
        xAxis     : _confiEjeX(movil),
        yAxis     : _confiEjeY(subtitulo_ejeY),
        plotOptions: _confiPlot(),
        responsive: _confiResponsive(),
        credits: {
                enabled: false
        }
    });
}