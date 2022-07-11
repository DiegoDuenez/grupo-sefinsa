<?php

require 'Pago.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];

$Pago = new Pago;

switch($func){

    case 'index':
        echo $Pago->index();
    break;

    case 'pagosCliente':
        $cliente_id = $_DATA['cliente_id'];
        echo $Pago->pagosCliente($cliente_id);
    break;

    case 'pagar':

        $pago_id = $_DATA['pago_id'];
        $prestamo_id = $_DATA['prestamo_id'];
        $pago_recibido = $_DATA['pago_recibido'];
        $pago_multa = $_DATA['pago_multa'];
        $concepto = $_DATA['concepto'];

        echo $Pago->pagar($pago_id, $prestamo_id, $pago_recibido, $pago_multa, $concepto);

    break;

}