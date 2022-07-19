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

    case 'abonosActivos':
        echo $Configuracion->abonosActivos();
    break;

    case 'semanasActivas':
        echo $Configuracion->semanasActivas();
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

    case 'createSemana':
        
        $cantidad = $_DATA['cantidad'];
        $interes = $_DATA['interes'];
        $tipo_abono = $_DATA['tipo_abono'];
        $semana_renovacion = $_DATA['semana_renovacion'];

        echo $Configuracion->createSemana($cantidad, $interes, $tipo_abono, $semana_renovacion);

    break;

    case 'editSemana':
        
        $cantidad = $_DATA['cantidad'];
        $interes = $_DATA['interes'];
        $tipo_abono = $_DATA['tipo_abono'];
        $semana_renovacion = $_DATA['semana_renovacion'];
        $id = $_DATA['id'];

        echo $Configuracion->editSemana($id, $cantidad, $interes, $tipo_abono, $semana_renovacion);

    break;

    case 'desactivarSemana':
       
        $id = $_DATA['id'];
        echo $Configuracion->desactivarSemana($id);

    break;


    case 'activarSemana':
        
        $id = $_DATA['id'];
        echo $Configuracion->activarSemana($id);

    break;

    case 'editMulta':
        
        $cantidad = $_DATA['cantidad'];
        $id = $_DATA['id'];

        echo $Configuracion->editMulta($id, $cantidad);

    break;

    case 'desactivarMulta':
       
        $id = $_DATA['id'];
        echo $Configuracion->desactivarMulta($id);

    break;


    case 'activarMulta':
        
        $id = $_DATA['id'];
        echo $Configuracion->activarMulta($id);

    break;

    case 'getMultaPorDefecto':
        
        echo $Configuracion->getMultaPorDefecto();

    break;

}