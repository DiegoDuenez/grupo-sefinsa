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

    case 'pagosPrestamo':
        $prestamo_id = $_DATA['prestamo_id'];
        echo $Pago->pagosPrestamo($prestamo_id);
    break;

    case 'pagosPrestamoPagados':
        $prestamo_id = $_DATA['prestamo_id'];
        echo $Pago->pagosPrestamoPagados($prestamo_id);
    break;

    case 'pagar':

        $pago_id = $_DATA['pago_id'];
        $prestamo_id = $_DATA['prestamo_id'];
        $pago_recibido = $_DATA['pago_recibido'];
        $pago_multa = $_DATA['pago_multa'];
        $concepto = $_DATA['concepto'];
        $fecha_pago = $_DATA['fecha_pago'];
        $folio = $_DATA['folio'];

        echo $Pago->pagar($pago_id, $prestamo_id, $pago_recibido, $pago_multa, $concepto, $fecha_pago, $folio);

    break;

    case 'puedeOmitirUltimaSemana':
        
        $prestamo_id = $_DATA['prestamo_id'];
        echo $Pago->puedeOmitirUltimaSemana($prestamo_id);

    break;

    case 'omitirSemanaPago':

        $pago_id = $_DATA['pago_id'];
        echo $Pago->omitirSemanaPago($pago_id);

    break;

    case 'fechasPago':

        $prestamo_id = $_DATA['prestamo_id'];
        echo $Pago->fechasPagos($prestamo_id);
    break;

    case 'noPagar':

        $pago_id = $_DATA['pago_id'];
        $pago_multa = $_DATA['pago_multa'];
       //$concepto = $_DATA['concepto'];

        echo $Pago->noPagar($pago_id, $pago_multa);

    break;

}