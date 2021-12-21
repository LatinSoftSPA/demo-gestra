<?php

namespace App\Http\Controllers\Imprimir;

use Illuminate\Http\Request;

//use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class PagosController extends ConfiguracionController
{
	private $_titulo = "PAGO DE MULTA\n";
	private $testStr = "Testing 123";
		
	//private $footer = EscposImage::load(public_path('assets\img\conductores.png'));
		
	public function imprimir($servicio, $multas, $nota_pago)
	{
		//$connector = new CupsPrintConnector($this->nomb_impre);
		$connector = new WindowsPrintConnector($this->nomb_impre);
		//$connector = new FilePrintConnector($this->nomb_impre);
		$printer = new Printer($connector);
		
		try {


			$inic_servi = new \DateTime($servicio['inic_servi']);
			$fech_servi = $inic_servi->format('d-m-Y');
			$hora_servi = $inic_servi->format('H:i');
			//$fech_servi = date("d-m-Y", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
			//$hora_servi = date("H:i", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
			
			$codi_servi = $servicio['codi_servi'];
						
			
			$this->titulo1($printer, $this->_titulo, Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);
			
			$printer->setLineSpacing(44);
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			
			$this->negrita2($printer, "Servicio   : ");
			$this->letra2($printer, $hora_servi);
			$this->negrita2($printer, "      Fecha: ");
			$this->letra2($printer, $fech_servi ."\n");
						
			$this->negrita2($printer, "Circuito   : ");
			$this->letra2($printer, $servicio['codi_circu'] ." - ". $servicio['nomb_circu']. "\n");
			
			$this->negrita2($printer, "Movil      : ");
			$this->letra2($printer, $servicio['nume_movil']);			
			$this->negrita2($printer, "         Patente : ");
			$this->letra2($printer, $servicio['pate_movil'] ."\n");
			
			$this->negrita2($printer, "Conductor  : ");
			$this->letra2($printer, $servicio['docu_perso'] ." - ". $servicio['conductor'] ."\n");			
			$this->lineaSeparacion1($printer);
			/**/
			
			$printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
			$codi_servi = sprintf("%'.012d", $codi_servi);
			$this->codigoBarras1($printer, $codi_servi);			
			$this->lineaSeparacion2($printer);
			
			//$printer->setReverseColors(true);
			$tabs = chr(11). chr(20). chr(32). chr(0);
			$printer->setHorizontalTab($tabs);
			$this->negrita2($printer, "SENTIDO");$printer->tabularH();
			$this->negrita2($printer, "MULTADO");$printer->tabularH();
			$this->negrita2($printer, "DESCUENTO");$printer->tabularH();
			$this->negrita2($printer, "COBRADO $");
			//$printer->setReverseColors(false);
			$this->negrita2($printer, "\n");
			$this->lineaSeparacion1($printer);
			
			/**/
			$printer->setHorizontalTab($tabs);
			$tota_pagar = 0;
			foreach($multas as $multa)
			{
				if($multa["codi_senti"] == 0){$this->negrita2($printer, "IDA");$printer->tabularH();}
				if($multa["codi_senti"] == 1){$this->negrita2($printer, "REG");$printer->tabularH();}
				$multado 	= number_format($multa["tota_multa"], 0, ", ", ".");
				$descuento 	= number_format($multa["tota_multa"] - $multa["tota_pagad"], 0, ", ", ".");
				$cobrado 	= number_format($multa["tota_pagad"], 0, ", ", ".");

				$this->letra2($printer, $multado);$printer->tabularH();
				$this->negrita2($printer, $descuento);$printer->tabularH();
				$this->negrita2($printer, $cobrado);
				$this->negrita2($printer, "\n");
				$tota_pagar += $multa["tota_pagad"];
			}
			$this->lineaSeparacion2($printer);
				
			$tota_pagar = number_format($tota_pagar, 0, ", ", ".");
			$this->titulo1($printer, "TOTAL $". $tota_pagar ."\n", Printer::JUSTIFY_CENTER);			
			$this->lineaSeparacion2($printer);
			
			
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "NOTA     : ");
			$this->letra2($printer, strtoupper($nota_pago) ."\n");
			$this->negrita2($printer, "RECAUDADO: ");
			$this->letra2($printer, \Auth::user()->docu_perso ." - ". \Auth::user()->prim_nombr ." ". \Auth::user()->apel_pater ."\n");
			
			$printer->setLineSpacing();
			$this->lineaSeparacion2($printer);

			
			$this->negrita2($printer, "PAG. Impreso: ");
			$this->letra2($printer, date("H:i:s d-m-Y"));
			$printer->feed(1);
			$printer->cut();
		} finally {
			$printer -> close();
			return 'imprimir PAGO DE MULTA';
		}
	}
	
	public function imprimirVouche($servicio, $multas, $nota_pago)
	{
		//$connector = new CupsPrintConnector($this->nomb_impre);
		$connector = new WindowsPrintConnector($this->nomb_impre);
		//$connector = new FilePrintConnector($this->nomb_impre);
		$printer = new Printer($connector);
		
		try {


			$inic_servi = new \DateTime($servicio['inic_servi']);
			$fech_servi = $inic_servi->format('d-m-Y');
			$hora_servi = $inic_servi->format('H:i');
			//$fech_servi = date("d-m-Y", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
			//$hora_servi = date("H:i", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
			
			$codi_servi = $servicio['codi_servi'];
			
			$printer->setLineSpacing(5);
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			
			$this->negrita2($printer, "Servicio   : ");
			$this->letra2($printer, $hora_servi);
			$this->negrita2($printer, "      Fecha: ");
			$this->letra2($printer, $fech_servi ."\n");
						
			$this->negrita2($printer, "Circuito   : ");
			$this->letra2($printer, $servicio['codi_circu'] ." - ". $servicio['nomb_circu']. "\n");
			
			$this->negrita2($printer, "Movil      : ");
			$this->letra2($printer, $servicio['nume_movil']);			
			$this->negrita2($printer, "         Patente : ");
			$this->letra2($printer, $servicio['pate_movil'] ."\n");
			
			$this->negrita2($printer, "Conductor  : ");
			$this->letra2($printer, $servicio['docu_perso'] ." - ". $servicio['conductor'] ."\n");			
			$this->lineaSeparacion1($printer);
			/**/
			
			//$printer->setReverseColors(true);
			$tabs = chr(11). chr(20). chr(32). chr(0);
			$printer->setHorizontalTab($tabs);
			$this->negrita2($printer, "SENTIDO");$printer->tabularH();
			$this->negrita2($printer, "MULTADO");$printer->tabularH();
			$this->negrita2($printer, "DESCUENTO");$printer->tabularH();
			$this->negrita2($printer, "COBRADO $");
			//$printer->setReverseColors(false);
			$this->negrita2($printer, "\n");
			$this->lineaSeparacion1($printer);
			
			/**/
			$printer->setHorizontalTab($tabs);
			foreach($multas as $multa)
			{
				if($multa["codi_senti"] == 0){$this->negrita2($printer, "IDA");$printer->tabularH();}
				if($multa["codi_senti"] == 1){$this->negrita2($printer, "REG");$printer->tabularH();}
				$multado 	= number_format($multa["tota_multa"], 0, ", ", ".");
				$descuento 	= number_format($multa["tota_multa"] - $multa["tota_pagad"], 0, ", ", ".");
				$cobrado 	= number_format($multa["tota_pagad"], 0, ", ", ".");
				$this->letra2($printer, $multado);$printer->tabularH();
				$this->negrita2($printer, $descuento);$printer->tabularH();
				$this->negrita2($printer, $cobrado);
				$this->negrita2($printer, "\n");
			}
			$this->lineaSeparacion1($printer);
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "NOTA     : ");
			$this->letra2($printer, strtoupper($nota_pago) ."\n");
			$this->negrita2($printer, "RECAUDADO: ");
			$this->letra2($printer, \Auth::user()->docu_perso ." - ". \Auth::user()->prim_nombr ." ". \Auth::user()->apel_pater ."\n");
			
			
			$this->lineaSeparacion2($printer);
			$this->negrita2($printer, "VOU. Impreso: ");
			$this->letra2($printer, date("H:i:s d-m-Y"));
			$printer->feed(1);
			$printer->cut();
		} finally {
			$printer -> close();
			return 'imprimir PAGO DE MULTA';
		}
	}

}