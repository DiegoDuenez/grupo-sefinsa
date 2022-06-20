<?php


require 'Cliente.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Cliente = new Cliente;

switch($func){

    case 'index':
        echo $Cliente->index();
    break;

}