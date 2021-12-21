var recaudador = 'Maritza Ines Ugarte';

function _confiGrafico(tipo)
{
  return {
    type: tipo,
    zoomType: 'x',
    panning: false,
    panKey: 'shift',
    scrollablePlotArea: {
      minWidth: 200
    }
  };
}

function _confiTitulo(titulo)
{
  return {
    text: '',
    style: {
      color: "#000",
      fontSize: '14px',
      fontStyle: 'bold'
    }
  };
}

function _confiSubTitulo(subtitulo)
{
  return {
    text: subtitulo,
    style: {
      fontSize: '10px',
      fontStyle: 'bold'
    }
  };  
}

function _confiTooltip()
{
  return {
    headerFormat  : '<b>Periodo: {point.key}</b><br/>',
    pointFormat   : '<small style=\"color:{series.color}\">{series.name}</small>: $<b>{point.y}</b><br/>',
    //pointFormat   : '<span style=\"color:{series.color}\">{series.name}</span>: <b>$ {point.y}</b><br/>',
    borderWidth: 5,
    shared: true,
  };
}

function _confiLegend(color)
{
  return {
    reversed: false,
    backgroundColor: color,
    borderRadius: 12,  
    borderWidth: 3,
    floating: false,   
  };
}

function _confiEjeY(subtituloY)
{
  return {
    title: {text: subtituloY},        
    labels: {
        format: '{value}',
        style: {
          fontStyle: 'bold'
        }
    },
    tickPixelInterval: 60,
    //gridLineColor: '#197F07',
    gridLineWidth: 2,
    allowDecimals : true
  };
}

function _confiEjeX(categorias)
{
    return {
        labels: {
            style: {
                fontStyle: 'bold'
            }
        },
        categories: categorias,
        //gridLineWidth: 1
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
        maxWidth: 250
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