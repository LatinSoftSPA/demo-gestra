var recaudador = 'Maritza Ines Ugarte';

function _confiGrafico(tipo)
{
  return {
    type: tipo,
    zoomType: 'x',
    scrollablePlotArea: {
      minWidth: 250
    }
  };
}

function _confiTitulo(titulo)
{
  return {
    text: titulo,
    style: {
      color: "#000",
      fontSize: '12px',
      fontStyle: 'bold'
    }
  };
}

function _confiSubTitulo(subtitulo)
{
  return {
    text: subtitulo,
    style: {
      fontSize: '8px',
      fontStyle: 'bold'
    }
  };  
}

function _confiTooltip()
{
  return {
    headerFormat  : '<b>Maq: {point.key}</b><br/>',
    pointFormat   : '<span style=\"color:{series.color}\">{series.name}</span>: <b>$ {point.y}</b><br/>',
    //pointFormat   : '<span style=\"color:{series.color}\">{series.name}</span>: <b>$ {point.y}</b><br/>',
    borderWidth: 4,
    shared: true,
  };
}

function _confiLegend(color)
{
  return {
    reversed: false,
    backgroundColor: color,
    borderRadius: 12,  
    borderWidth: 2,
    floating: false,   
  };
}

function _confiEjeY(subtituloY)
{
  return {
  	title: {text: subtituloY},        
    labels: {format: '$ {value}'}
  };
}

function _confiPlot()
{
  return {
    areaspline: {
      fillOpacity: 0.7
    },
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      depth: 35,
      showInLegend: true,
      dataLabels: {
        enabled: false
      }
    }
  };
}

function _confiResponsive()
{
  return {
    rules: [{
      condition: {
        maxWidth: 300
      },
      chartOptions: {
        legend: {
          align: 'center',
          verticalAlign: 'bottom',
          layout: 'horizontal'
        }
      }
    }]
  };
}



/*
Highcharts.chart('grafico_cuotas', {
    chart     : _confiGrafico('column'),
    title     : _confiTitulo(titulo_cuotas),
    subtitle  : _confiSubTitulo(subtitulo_cuotas),
    tooltip   : _confiTooltip(),
    legend    : _confiLegend('#E0EF2C'),
    series    : data_cuotas,
    xAxis     : confiEjeX,
    yAxis     : _confiEjeY(subY_cuotas),
    plotOptions: _confiPlot(),
    responsive: _confiResponsive(),
    credits: {
        enabled: false
    }
});

Highcharts.chart('grafico_recaudaciones', {
    chart     : 
    {
      type: 'pie',
      zoomType: 'x',
      scrollablePlotArea: {
        minWidth: 250
      },
      options3d: {  
          enabled: true,
          alpha: 60,
          beta: 0
      }
    },
    title     : _confiTitulo(titulo_recaudaciones),
    //subtitle  : _confiSubTitulo(subtitle),
    tooltip   : {pointFormat: '{series.name}: <b>${point.y}</b>'},
    legend    : _confiLegend('#E0EF2C'),
    series    : data_recaudaciones,
    plotOptions: _confiPlot(),
    responsive: _confiResponsive(),
    credits: {
        enabled: false
    }
});
*/