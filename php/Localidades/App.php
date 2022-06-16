<?php

require 'Localidad.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Localidad = new Localidad;

switch($func){

    case 'index':
        echo $Localidad->index();
    break;

    case 'create':
        $ruta_id = $_DATA['ruta_id'];
        $nombre_localidad = $_DATA['nombre_localidad'];
        echo $Localidad->create($nombre_localidad, $ruta_id);
    break;

    case 'edit':
        $id = $_DATA['id'];
        $ruta_id = $_DATA['ruta_id'];
        $nombre_localidad = $_DATA['nombre_localidad'];
        echo $Localidad->edit($nombre_localidad, $ruta_id, $id);
    break;


    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Localidad->localidadesRuta($id);
    break;

    default:
        echo notDefine();
    break;

}