<?php

require 'Pago.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];

$Pago = new Pago;

switch($func){

    case 'index':
        echo $Pago->index();
    break;

}