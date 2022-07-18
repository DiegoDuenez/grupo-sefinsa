<?php

require 'Configuracion.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Configuracion = new Configuracion;

switch($func){

    case 'index':
        $tipo = sanitize($_DATA['tipo']);
        echo $Configuracion->index($tipo);
    break;

    case 'createAbonos':
        
        $cantidad = $_DATA['cantidad'];
        $tipo_cantidad = $_DATA['tipo_cantidad'];
        $descripcion = $_DATA['descripcion'];
        $de = $_DATA['de'];
        $por_cada = $_DATA['por_cada'];


        echo $Configuracion->createAbonos($cantidad, $tipo_cantidad, $descripcion, $de, $por_cada);

    break;

}