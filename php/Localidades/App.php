<?php

require 'Localidad.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Localidad = new Localidad;

switch($func){

    case 'index':
        echo $Localidad->index();
    break;

    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Localidad->localidadesRuta($id);
    break;

    default:
        echo notDefine();
    break;

}