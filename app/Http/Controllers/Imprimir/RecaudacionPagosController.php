<?php

namespace App\Http\Controllers\Imprimir;

use Illuminate\Http\Request;

//use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class RecaudacionPagosController extends ConfiguracionController
{
	private $_titulo = "RECAUDACION DE MULTAS\n";
		
	public function imprimir(Request $request)
	{
		$fech_recau = $request->fech_recau;
		$total_multas = $request->total_multas;
		$total_descue = $request->total_descue;
		$total_cobros = $request->total_cobros;

		//$connector = new CupsPrintConnector($this->nomb_impre);
		$connector = new WindowsPrintConnector($this->nomb_impre);
		//$connector = new FilePrintConnector($this->nomb_impre);
		$printer = new Printer($connector);
		
		try 
		{
			$fech_recau = Carbon::now()->toDateTimeString();		
			//$fech_recau = Carbon::createFromTimeString($servicio['fech_recau'])->toDateTimeString();
			
			$total_multas = 650000;
			$total_descue = 300000;
			$total_cobros = 12000;
			
			$this->titulo1($printer, $this->_titulo, Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);
			
			$printer->setLineSpacing(44);
			$printer->setJustification(Printer::JUSTIFY_LEFT);			
			$tabs = chr(11). chr(20). chr(32). chr(0);
			$this->negrita2($printer, "Recaudador");$printer->tabularH();
			$this->letra2($printer, ": ");
			$this->letra2($printer, \Auth::user()->prim_nombr ." ". \Auth::user()->apel_pater ."\n");
			$this->negrita2($printer, "Codigo");$printer->tabularH();
			$this->letra2($printer, ": ");
			$this->letra2($printer, \Auth::user()->docu_perso ."\n");
			
			$this->negrita2($printer, "Fecha");$printer->tabularH();
			$this->letra2($printer, ": ");
			$this->letra2($printer, $fech_recau ."\n");
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);
			
			//----------------------------------------------------------------------------------
			$printer->setLineSpacing();
			$tabs = chr(11). chr(20). chr(32). chr(0);
			$printer->setHorizontalTab($tabs);
			$this->negrita2($printer, "MULTADOS");$printer->tabularH();
			$total_multas 	= number_format($total_multas, 0, ", ", ".");
			$this->letra2($printer, $total_multas ."\n");

			$this->negrita2($printer, "DESCUENTOS");$printer->tabularH();
			$total_descue 	= number_format($total_descue, 0, ", ", ".");
			$this->letra2($printer, $total_descue ."\n");

			$this->negrita2($printer, "COBRADOS");$printer->tabularH();
			$total_cobros 	= number_format($total_cobros, 0, ", ", ".");
			$this->letra2($printer, $total_cobros ."\n");
			//----------------------------------------------------------------------------------			
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);
				
			$this->titulo1($printer, "COBRADO $". $total_cobros ."\n", Printer::JUSTIFY_CENTER);
			
			$printer->setJustification(Printer::JUSTIFY_CENTER);			
			$this->lineaSeparacion2($printer);		
			
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "RECAUDADOR");$printer->tabularH();
			$this->negrita2($printer, ": ");
			$this->letra2($printer, \Auth::user()->docu_perso ." - ". \Auth::user()->prim_nombr ." ". \Auth::user()->apel_pater ."\n");
			
			$this->negrita2($printer, "FIRMA");$printer->tabularH();
			$this->negrita2($printer, ":");
			$printer->feed(3);
						
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);

			
			$this->negrita2($printer, "REC. Impreso: ");
			$this->letra2($printer, Carbon::now()->format("H:i:s d-m-Y"));
			$printer->feed(1);
			$printer->cut();
		} finally {
			$printer -> close();
			return 'imprimir RECAUDACION DE MULTAS';
		}
	}
}