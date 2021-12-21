var titulo_multas = '';
var subtitulo_multas = 'Multas Cobradas';
var subtitulo_ejeY = 'Multados/Cobrados';

function _dataMultas(multados, cobrados)
{
    return [
        {
            name: 'Multado',
            data: multados,
            color: '#c4392d',
        }, 
        {
            name: 'Cobrado',
            data: cobrados,
            color: '#42DA24',
        }
    ];
}

function _dataCategories(categorias)
{
    return {
        categories: categorias
    };
}

function _crearGraficoMultas(data)
{
	var periodos = [];
	var exigidos = [];
	var registrados = [];
	$.each(data.multas, function(i, obj){
        console.dir(obj);
		periodos.push(obj.MOVIL);
		exigidos.push(obj.TOTAL);
		registrados.push(obj.COBRADO);
	});

    Highcharts.chart('grafico_multas', {
        chart     : _confiGrafico('areaspline'),
        title     : _confiTitulo(titulo_multas),
        subtitle  : _confiSubTitulo(subtitulo_multas),
        tooltip   : _confiTooltip(),
        legend    : _confiLegend('#E0EF2C'),
        series    : [
            {
                name: 'Multa',
                data: exigidos,
                color: '#c4392d',
            },
            {
                name: 'Cobrado',
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