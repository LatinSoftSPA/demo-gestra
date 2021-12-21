<?php

namespace App\Http\Controllers\Imprimir;

use App\Http\Controllers\Controller;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;


class ConfiguracionController extends Controller
{
	//public $nomb_impre = "/dev/ttyUSB0";
	//public $nomb_impre = "smb://pc-virtual/epson_tm";
	protected $nomb_impre;
	

	//public $footer = EscposImage::load(public_path('assets\img\conductores.png'));
	public function __construct()
	{
		$this->nomb_impre = config('app.impresora', 'EPSON-TM'); 
	}
	

	public function lineaSeparacion1(Printer $printer)
	{
		$printer->selectPrintMode(Printer::MODE_FONT_B);
		$printer->text("----------------------------------------------------------------\n");
		$printer->selectPrintMode();
	}
	
	public function lineaSeparacion2(Printer $printer)
	{
		$printer->selectPrintMode(Printer::MODE_FONT_B);
		$printer->text("================================================================\n");
		$printer->selectPrintMode();
	}
	
	public function titulo1(Printer $printer, $str, $justificacion)
    {
		$printer->setJustification($justificacion);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_EMPHASIZED);
		$printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function titulo2(Printer $printer, $str, $justificacion)
    {
		$printer->setJustification($justificacion);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
		$printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function titulo3(Printer $printer, $str, $justificacion)
    {
		$printer->setJustification($justificacion);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
		$printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function letra1(Printer $printer, $str)
    {
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function letra2(Printer $printer, $str)
    {
        $printer->selectPrintMode(Printer::MODE_FONT_B);
        $printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function letra3(Printer $printer, $str)
    {
        $printer->selectPrintMode(Printer::MODE_FONT_C);
        $printer->text($str);
        $printer->selectPrintMode();
    }
	
	
	public function negrita1(Printer $printer, $str)
    {
        $printer->selectPrintMode(Printer::MODE_FONT_A | Printer::MODE_EMPHASIZED);
        $printer->text($str);
        $printer->selectPrintMode();
    }
	
	public function negrita2(Printer $printer, $str)
    {
        $printer->selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_EMPHASIZED);
        $printer->text($str);
        $printer->selectPrintMode();
    }
		
	public function codigoBarras1(Printer $printer, $str)
    {
		$height = 32; 								//1, 2, 4, 8, 16, 32
		$width = 8;									//1, 2, 3, 4, 5, 6, 7, 8
		$position = Printer::BARCODE_TEXT_BELOW;	//Printer::BARCODE_TEXT_NONE, Printer::BARCODE_TEXT_ABOVE, Printer::BARCODE_TEXT_BELOW
		$printer->setBarcodeHeight($height);
		$printer->setBarcodeWidth($width);
		$printer->setBarcodeTextPosition($position);
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->barcode($str, Printer::BARCODE_JAN13);
		$printer->setJustification();
    }
	
	public function codigoQR(Printer $printer, $content)
	{
		$size = 4;
		$ec = Printer::QR_ECLEVEL_M;		//Printer::QR_ECLEVEL_L, Printer::QR_ECLEVEL_M, Printer::QR_ECLEVEL_Q, Printer::QR_ECLEVEL_H;
		$model = Printer::QR_MICRO;			//Printer::QR_MODEL_1, Printer::QR_MODEL_2, Printer::QR_MICRO
		
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->qrCode($content, $ec, $size, $model);
		$printer->setJustification(Printer::JUSTIFY_LEFT);
	}
	
	public function codigoPDF417(Printer $printer, $content)
	{
		$width = 3;								//2 = (minimum), 3 = (default), 4 = "", 8 = (maximum)
		$heightMultiplier = 3;					//2 = (minimum), 3 = (default), 4 = "", 8 = (maximum)
		$dataColumnCount = 0;
		$ec = 4.0;
		$options = Printer::PDF417_STANDARD;	//Printer::PDF417_STANDARD, Printer::PDF417_TRUNCATED
		//$printer->pdf417Code($content, $width, $heightMultiplier, $dataColumnCount, $ec, $options);
		
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->pdf417Code($content, $width, $heightMultiplier, $dataColumnCount);
		$printer->setJustification(Printer::JUSTIFY_LEFT);
	}

	public function imagen(Printer $printer, $url = null)
	{
		//$url = "img/tux.png";
		$laImagen = EscposImage::load($url, false);
    
    	$printer->setJustification(Printer::JUSTIFY_CENTER);
    	$this->lineaSeparacion2($printer);
	    $printer->graphics($laImagen);
	    $this->lineaSeparacion2($printer);
	    $printer->feed(1);
	    $printer->cut();
	}
}