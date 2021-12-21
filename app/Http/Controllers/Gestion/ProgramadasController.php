<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Modelos\DBServicios\ViewListarProgramadas;
use App\Modelos\DBServicios\Programada;
use App\Modelos\DBServicios\Servicio;
use App\Modelos\DBServicios\Multa;

//-----------------------------------
use Carbon\Carbon;
class ProgramadasController extends Controller
{
    private $_valor_multa = 1000;

    private function _crear($s, $c, $m, $e, $t, $f)
	{
		Multa::create([
            'codi_servi' => $s,
            'codi_circu' => $c,
            'nume_movil' => $m,
            'codi_senti' => $e,
            'tota_multa' => $t,
            'fech_multa' => $f,
            'user_modif' => \Auth::user()->docu_perso,
        ]);
    }
    
    public function procesarProgramadas($servicio, $controladas, $codi_senti)
    {
        $codi_servi = $servicio['codi_servi'];
        $codi_circu = $servicio['codi_circu'];
        $nume_movil = $servicio['nume_movil'];
        $pate_movil = $servicio['pate_movil'];

        $totalMulta = 0;
        $servicio_multado = false;

        foreach($controladas as $controlada)
        {
            $codi_geoce = $controlada['geozoneID'];
            $programada = $this->_buscarProgramada($servicio, $codi_geoce, $codi_senti);
            
            if($programada->count() > 0){
                $cabecera   = intval($controlada['heading']);
                $angulo     = $programada[0]['angulo'];

                $valido = $this->_anguloIncidente($cabecera, $angulo);
                if($valido)
                {
                    $fech_progr = $programada[0]['fech_progr'];
                    $minu_toler = $programada[0]['minu_toler'];

                    $d = floor(($controlada['timestamp'] - strtotime($fech_progr)) / 60);
                    $multado = false;
                    $multa = 0;
                    if(intval($minu_toler) != 99)
                        if(intval($d) > 0){
                        {
                            $multado = true;
                            $multa = $this->_calcularMulta(intval($d), intval($minu_toler));

                        }
                    }
                    $totalMulta += $multa;
                    
                    $this->_actualizarProgramada($servicio, $controlada, $codi_senti, $d, $multa, $multado);
                    usleep(10000);
                }
            }
        }
        unset($controlada);

        $multado = false;
        if($totalMulta > 0)
        {
            $multado = true;
            $this->_crear($codi_servi, $codi_circu, $nume_movil, $codi_senti, $totalMulta, date('Y-m-d', $codi_servi));
        }
        Servicio::where('codi_servi', $codi_servi)
            ->where('codi_circu', $codi_circu)
            ->where('nume_movil', $nume_movil)
            ->where('pate_movil', $pate_movil)
            ->where('multado', false)
            ->update(
            [
                'multado'   => $multado,
                'procesar'  => false
            ]);
    }

    public function _calcularMulta($diferencia, $tolerancia)
    {
        $multa = 0;
        if($tolerancia > 0){
            if($diferencia > $tolerancia){
                return ($diferencia - $tolerancia) * $this->_valor_multa;
            }
        }elseif($diferencia > 0){
            return $diferencia * $this->_valor_multa;
        }
        return $multa;
    }

    private function _buscarProgramada($servicio, $codi_geoce, $codi_senti)
    {
        $codi_servi = $servicio['codi_servi'];
        $codi_circu = $servicio['codi_circu'];

        return ViewListarProgramadas::_buscar($codi_servi, $codi_circu, $codi_senti, $codi_geoce);
    }

    private function _actualizarProgramada($servicio, $controlada, $codi_senti, $d, $multa, $multado)
    {
        $codi_servi = $servicio['codi_servi'];
        $codi_circu = $servicio['codi_circu'];

        $codi_geoce = $controlada['geozoneID'];
        $f = $controlada['timestamp'];
        $lat = $controlada['latitude'];
        $lon = $controlada['longitude'];
        $h = $controlada['heading'];
        $v = $controlada['speedKPH'];

        $programada = Programada::_actualizarProgramada($codi_servi, $codi_circu, $codi_senti, $codi_geoce, $f, $lat, $lon, $h, $v, $d, $multa, $multado);
    }

    private function _anguloIncidente($cabecera, $angulo)
    {
        $incidencia = false;

        if($angulo == 0){
            $min = 360 - 40;
            $max = 0 + 40;

            if(($cabecera >= $min && $cabecera <= 360)|| ($cabecera >= 0 && $cabecera <= $max))
            {
                $incidencia = true;
            }
        } else {
            $min = intval($angulo) - 40;
            $max = intval($angulo) + 40;

            if($cabecera >= $min && $cabecera <= $max)
            {
                $incidencia = true;
            }
        }
        return $incidencia;
    }
}