<?php

require 'Modulo.php';
require '../FileManager.php';


$_DATA = json_decode(file_get_contents('php://input'), true);

if(isset($_DATA['func'])){
    $func = $_DATA['func'];
}

if(isset($_POST['func'])){
    $func = $_POST['func'];
}

$Modulo= new Modulo;

switch($func){

    case 'index':
        echo $Modulo->index();
    break;

    case 'modulosActivos':
        echo $Modulo->modulosActivos();
    break;


}