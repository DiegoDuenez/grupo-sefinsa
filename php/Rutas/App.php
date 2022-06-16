<?php

require 'Ruta.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Ruta = new Ruta;

switch($func){

    case 'index':
        echo $Ruta->index();
    break;

    case 'create':
        $nombre = $_DATA['nombre_ruta'];
        echo $Ruta->create($nombre);
    break;

    case 'edit':
        $id = $_DATA['id'];
        $nombre = $_DATA['nombre_ruta'];
        echo $Ruta->edit($nombre, $id);
    break;

    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Ruta->localidadesRuta($id);
    break;

    default:
        echo notDefine();
    break;

}