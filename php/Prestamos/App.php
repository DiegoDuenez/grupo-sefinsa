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

    case 'create':

        /*$cliente_id = $_DATA['cliente_id'];
        $monto_prestado = $_DATA['monto_prestado'];
        $pago_semanal = $_DATA['pago_semanal'];
        $fecha_prestamo = $_DATA['fecha_prestamo'];

        echo $Prestamo->create($cliente_id, $monto_prestado, $pago_semanal, $fecha_prestamo);*/

    break;

}