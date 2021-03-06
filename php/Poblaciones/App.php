<?php

require 'Poblacion.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Poblacion = new Poblacion;

switch($func){

    case 'index':
        echo $Poblacion->index();
    break;

    case 'poblacionesRuta':
        $ruta_id = $_DATA['ruta_id'];
        echo $Poblacion->poblacionesRuta($ruta_id);
    break;

    case 'create':
        $ruta_id = $_DATA['ruta_id'];
        $nombre_localidad = sanitize($_DATA['nombre_localidad']);
        $primer_hora_limite = sanitize($_DATA['primer_hora_limite']);
        $segunda_hora_limite = sanitize($_DATA['segunda_hora_limite']);
        $dia_cobro = sanitize($_DATA['dia_cobro']);
        $grupo = $_DATA['grupo'];
        //$segundo_dia_cobro = sanitize($_DATA['segundo_dia_cobro']);
        $monto_multa = $_DATA['monto_multa'];

        echo $Poblacion->create($nombre_localidad, $ruta_id, $primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo);

    break;

    case 'edit':
        $id = $_DATA['id'];
        $ruta_id = $_DATA['ruta_id'];
        $nombre_localidad = sanitize($_DATA['nombre_localidad']);
        $primer_hora_limite = sanitize($_DATA['primer_hora_limite']);
        $segunda_hora_limite = sanitize($_DATA['segunda_hora_limite']);
        $dia_cobro = sanitize($_DATA['dia_cobro']);
        $grupo = $_DATA['grupo'];
        $monto_multa = $_DATA['monto_multa'];

        echo $Poblacion->edit($nombre_localidad, $ruta_id, $id,$primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo);
    break;

    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Poblacion->localidadesRuta($id);
    break;

    default:
        echo notDefine();
    break;

}