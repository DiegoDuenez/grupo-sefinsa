<?php

include '../database.php';
include '../response.php';
require 'Prestamo.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

if(isset($_DATA['func'])){
    $func = $_DATA['func'];
}

$Prestamo = new Prestamo;

switch($func){

    case 'index':
        
        echo $Prestamo->index();
    break;

    case 'getPrestamo':

        $prestamo_id = $_DATA['prestamo_id'];
        echo $Prestamo->getPrestamo($prestamo_id);
    break;

    case 'generarPagos':

        $prestamo_id = $_DATA['prestamo_id'];
        $fecha_pago = $_DATA['fecha_pago'];
        $cantidad_semanas = $_DATA['cantidad_semanas'];
        $cantidad_esperada = $_DATA['cantidad_esperada'];
        $cantidad_pagada = 0;
        $cantidad_multa = $_DATA['cantidad_multa'];
        $cantidad_total = $cantidad_esperada + $cantidad_multa;

        echo $Prestamo->generarPagos($prestamo_id, $fecha_pago, $cantidad_semanas, $cantidad_esperada, $cantidad_pagada, $cantidad_multa, $cantidad_total);

    break;

    case 'renovarPrestamo':

        $prestamo_id = $_DATA['prestamo_id'];
        $tarjeton = $_DATA['tarjeton'];
        $monto_renovar = $_DATA['monto_renovar'];
        $pago_semanal = $_DATA['pago_semanal'];
        $fecha_prestamo = $_DATA['fecha_prestamo'];
        $monto_debe = $_DATA['monto_debe'];

        echo $Prestamo->renovarPrestamo($prestamo_id, $tarjeton, $monto_renovar, $pago_semanal, $fecha_prestamo, $monto_debe);

    break;

    case 'create':

        /*$cliente_id = $_DATA['cliente_id'];
        $monto_prestado = $_DATA['monto_prestado'];
        $pago_semanal = $_DATA['pago_semanal'];
        $fecha_prestamo = $_DATA['fecha_prestamo'];

        echo $Prestamo->create($cliente_id, $monto_prestado, $pago_semanal, $fecha_prestamo);*/

    break;

    case 'prestamosRuta':

        $id = $_DATA['ruta_id'];
        echo $Prestamo->prestamosRuta($id);
        
    break;

    case 'prestamosPoblacion':

        $id = $_DATA['poblacion_id'];
        echo $Prestamo->prestamosPoblacion($id);
        
    break;

    case 'prestamosCliente':

        $id = $_DATA['cliente_id'];
        echo $Prestamo->prestamosCliente($id);

    break;

    case 'prestamosColocadora':

        $id = $_DATA['colocadora_id'];
        echo $Prestamo->prestamosColocadora($id);

    break;

}