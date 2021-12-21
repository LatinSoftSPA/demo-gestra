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