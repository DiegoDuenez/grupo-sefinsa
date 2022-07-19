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

    case 'createAbono':
        
        $cantidad = $_DATA['cantidad'];
        $tipo_cantidad = $_DATA['tipo_cantidad'];
        $descripcion = $_DATA['descripcion'];
        $de = $_DATA['de'];
        $por_cada = $_DATA['por_cada'];


        echo $Configuracion->createAbono($cantidad, $tipo_cantidad, $descripcion, $de, $por_cada);

    break;

    case 'editAbono':
        
        $cantidad = $_DATA['cantidad'];
        $tipo_cantidad = $_DATA['tipo_cantidad'];
        $descripcion = $_DATA['descripcion'];
        $de = $_DATA['de'];
        $por_cada = $_DATA['por_cada'];
        $id = $_DATA['id'];

        echo $Configuracion->editAbono($id, $cantidad, $tipo_cantidad, $descripcion, $de, $por_cada);

    break;

    case 'desactivarAbono':
       
        $id = $_DATA['id'];

        echo $Configuracion->desactivarAbono($id);

    break;


    case 'activarAbono':
        
        $id = $_DATA['id'];

        echo $Configuracion->activarAbono($id);

    break;

}