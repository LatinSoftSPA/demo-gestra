<?php

namespace App\Http\Controllers\Imprimir\Recaudaciones;
use App\Http\Controllers\Imprimir\ConfiguracionController;
use Illuminate\Http\Request;

//use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

use Carbon\Carbon;
class MultasController extends ConfiguracionController
{
	private $_titulo = "CUADRATURA DE MULTAS\n";
		
	//private $footer = EscposImage::load(public_path('assets\img\conductores.png'));
	public function imprimir($multas, $recaudador, $fech_desde)
	{
		$connector = new WindowsPrintConnector($this->nomb_impre);
		$printer = new Printer($connector);
		try 
		{
			$cobrado = intval($multas->COBRADO);
			$descontado = intval($multas->DESCONTADO);
			$multados = $cobrado + $descontado;
			$docu_perso = $recaudador->docu_perso;
			$responsable = $recaudador->RECAUDADOR;
			$rol = $recaudador->rol;
		
		
			$this->titulo1($printer, $this->_titulo, Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);
			$printer->setLineSpacing(46);
			
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "Recaudador : ");
			$this->letra2($printer, $responsable. "\n");
			$this->negrita2($printer, "Codigo     : ");
			$this->letra2($printer, $docu_perso. "\n");
			$this->negrita2($printer, "Rol        : ");
			$this->letra2($printer, $rol. "\n");
			$this->negrita2($printer, "Fecha      : ");
			$this->letra2($printer, $fech_desde."\n");
			$this->negrita2($printer, "Terminal   : ");
			$this->letra2($printer, "GARITA NORTE - LINEA 104\n");
			$this->lineaSeparacion2($printer);
			//=====================================================================================

			//$printer->setReverseColors(true);
			//$this->negrita2($printer, "DESGLOSE DE LA CUADRATURA\n", Printer::JUSTIFY_CENTER);
			//$printer->setReverseColors(false);
			//$this->lineaSeparacion1($printer);
			$tabs = chr(6). chr(11). chr(0);
			$printer->setHorizontalTab($tabs);
			$this->negrita2($printer, "20.000");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "10.000");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "5.000");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "2.000");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "1.000");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "500");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "100");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			$this->negrita2($printer, "50");$printer->tabularH();
			$this->negrita2($printer, "_____________________________________________________\n");
			/**/
			$this->titulo1($printer, "TOTAL : $" .$cobrado. ".-\n", Printer::JUSTIFY_CENTER);			
			$this->lineaSeparacion2($printer);
			
			$printer->setReverseColors(true);
			$this->negrita2($printer, "DETALLE DE MULTAS\n", Printer::JUSTIFY_CENTER);			
			$printer->setReverseColors(false);
			
			//$this->lineaSeparacion1($printer);
			$this->negrita2($printer, "MULTADOS : $" .$multados. ".-\n", Printer::JUSTIFY_CENTER);
			$this->negrita2($printer, "DESCUENTOS : $" .$descontado. ".-\n", Printer::JUSTIFY_CENTER);
			$printer->setJustification(Printer::JUSTIFY_LEFT);
				
			$this->lineaSeparacion2($printer);
			$this->negrita2($printer, "INF. Impreso: ");
			$this->letra2($printer, Carbon::now()->format('H:i:s d-m-Y'));
			$printer->feed(1);
			$printer->cut();
		} catch (Exception $e) {
		    return $printer->text($e->getMessage() . "\n");
		} finally {
			$printer->close();
			//return 'IMPRIMIENDO EN: ' .$this->nomb_impre;
		}
	}	
}