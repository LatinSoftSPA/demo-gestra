<?php

namespace App\Http\Controllers\Imprimir;

use App\Http\Controllers\Imprimir\ConfiguracionController;
//use Illuminate\Http\Request;

//use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

use Carbon\Carbon;

class ServiciosController extends ConfiguracionController
{
	private $ahorro_papel = false;
	private $letra_pequena = true;

	// private $_urlQR = "http://gestra.latinsoft.cl/api/conductores/servicio/";
	private $_urlQR = "http://190.164.82.121/gestra/api/conductores/servicio/";
	//private $testStr = 'Nombre\Apellidos\DNI';
	//private $footer = EscposImage::load(public_path('assets\img\conductores.png'));

	public function imprimir($mi_servicio, $tu_servicio)
	{
		$servicio = $mi_servicio['servicio'];
		$controladas = $mi_servicio['controladas'];

		$connector = new WindowsPrintConnector($this->nomb_impre);
		$printer = new Printer($connector);

		try {
			$inic_servi = Carbon::createFromTimeString($servicio['inic_servi'])->toDateTimeString();
			$fech_servi = Carbon::createFromTimeString($servicio['inic_servi'])->format('d-m-Y');
			$hora_servi = Carbon::createFromTimeString($servicio['inic_servi'])->format('H:i');

			//$fech_servi = date("d-m-Y", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
			//$hora_servi = date("H:i", strtotime($this->_zonaHoraria, $servicio['inic_servi']));

			$codi_servi = $servicio['codi_servi'];
			$codi_circu = $servicio['codi_circu'];
			$codi_QR = $this->_urlQR . $codi_circu . '/' . $codi_servi;

			$printer->setLineSpacing(44);
			$this->negrita2($printer, "Movil      : ");
			$this->titulo3($printer, $servicio['nume_movil'], Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "      Patente : ");
			$this->letra2($printer, $servicio['pate_movil'] . "\n");
			//$this->negrita2($printer, "Fecha Vencimiento Revicion Tecnica : ");
			//$this->letra2($printer, $servicio['fech_revis'] . "\n");

			$this->negrita2($printer, "Conductor  : ");
			$this->letra2($printer, $servicio['docu_perso'] . " - " . $servicio['conductor'] . "\n");
			$this->negrita2($printer, "Fecha      : ");
			$this->letra2($printer, $fech_servi);
			$this->negrita2($printer, " Hora : ");
			$this->letra2($printer, $hora_servi . "\n");

			$this->negrita2($printer, "Circuito   : ");
			$this->letra2($printer, $servicio['codi_circu'] . " - " . $servicio['nomb_circu'] . "\n");

			if ($tu_servicio !== null) {
				$servicio2 = $tu_servicio['servicio'];

				$inic_servi2 = Carbon::createFromTimeString($servicio2['inic_servi'])->toDateTimeString();
				//$fech_servi2 = Carbon::createFromTimeString($servicio2['inic_servi'])->format('d-m-Y');
				$hora_servi2 = Carbon::createFromTimeString($servicio2['inic_servi'])->format('H:i');

				$codi_servi = $servicio2['codi_servi'];
				$codi_circu = $servicio2['codi_circu'];


				$mi_salida = Carbon::parse($inic_servi);
				$tu_salida = Carbon::parse($inic_servi2);
				$diferencia = $mi_salida->diffInMinutes($tu_salida, true);
				$this->negrita2($printer, "Frecuencia : ");
				$this->letra2($printer, $diferencia . " MINUTOS\n");
				//$this->lineaSeparacion1($printer);
				$this->negrita2($printer, "*************************MOVIL ANTERIOR*************************\n");

				$printer->setLineSpacing(44);
				$this->negrita2($printer, "Movil      : ");
				$this->letra2($printer, $servicio2['nume_movil'], Printer::JUSTIFY_LEFT);
				$this->negrita2($printer, " Hora : ");
				$this->letra2($printer, $hora_servi2 . "\n");

				$this->negrita2($printer, "Conductor  : ");
				$this->letra2($printer, $servicio2['docu_perso'] . " - " . $servicio2['conductor'] . "\n");
			}
			/**/

			$this->lineaSeparacion2($printer);
			$this->codigoQR($printer, $codi_QR);
			$this->lineaSeparacion1($printer);
			$this->titulo1($printer, "SERVICIO : " . $hora_servi . "\n", Printer::JUSTIFY_CENTER);
			$this->lineaSeparacion2($printer);

			$regresando = FALSE;
			foreach ($controladas as $obj) {
				if ($obj['codi_senti'] == 1 and $regresando == FALSE) {
					$this->lineaSeparacion1($printer);
					$this->titulo1($printer, "*******REGRESO*******\n", Printer::JUSTIFY_CENTER);
					$regresando = TRUE;
				}
				//<--LINUX
				//$fecha = date("H:i:s d-m-Y", strtotime($this->_zonaHoraria, $servicio['inic_servi']));
				//$hh_mm = substr($fecha, 0, 5);

				//<--WINDOWs
				//$fecha = $obj['fech_progr'];
				//$hh_mm = substr($fecha, 11, 5);

				$inic_servi = new \DateTime($obj['fech_progr']);
				//$fecha = $inic_servi->format('d-m-Y');
				$hh_mm = $inic_servi->format('H:i');
				if ($obj['minu_toler'] > 0) {
					//$this->titulo1($printer, $hh_mm, Printer::JUSTIFY_LEFT);
					$this->titulo3($printer, $hh_mm, Printer::JUSTIFY_LEFT);
					$this->negrita1($printer, "+" . $obj['minu_toler'] . " ");
					// $control = $obj['nomb_geoce'];
				} else {
					//$this->titulo1($printer, $hh_mm ."  ", Printer::JUSTIFY_LEFT);
					$this->titulo3($printer, $hh_mm . "  ", Printer::JUSTIFY_LEFT);
					// $control = $obj['nomb_geoce'];
				}
				$control = $obj['nomb_geoce'];
				//$this->titulo1($printer, substr($control, 0, 14) ."\n", Printer::JUSTIFY_LEFT);
				$this->titulo3($printer, substr($control, 0, 14) . "\n", Printer::JUSTIFY_LEFT);
				if (!$this->ahorro_papel) {
					$printer->feed(1);
				}
			}
			$this->lineaSeparacion2($printer);

			//$this->codigoBarras1($printer, "012345678901");
			//$this->lineaSeparacion1($printer);
			//$printer->setLineSpacing();

			/**/
			//$this->codigoPDF417($printer, $this->testStr);
			//$this->lineaSeparacion2($printer);
			/**/
			$printer->setJustification(Printer::JUSTIFY_LEFT);
			$this->negrita2($printer, "INF. Impreso: ");
			$this->letra2($printer, date("H:i:s d-m-Y"));
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
