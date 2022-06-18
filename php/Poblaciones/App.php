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
        echo $Poblacion->create($nombre_localidad, $ruta_id);
    break;

    case 'edit':
        $id = $_DATA['id'];
        $ruta_id = $_DATA['ruta_id'];
        $nombre_localidad = sanitize($_DATA['nombre_localidad']);
        echo $Poblacion->edit($nombre_localidad, $ruta_id, $id);
    break;

    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Poblacion->localidadesRuta($id);
    break;

    default:
        echo notDefine();
    break;

}