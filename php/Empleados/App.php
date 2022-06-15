<?php

require 'Empleado.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Empleado = new Empleado;

switch($func){

    case 'index':
        echo $Empleado->index();
    break;

    case 'create':

        $user = $_DATA['usuario'];
        $nombre = $_DATA['nombre_completo'];
        $pwd = $_DATA['password'];
        $perfil_id = $_DATA['perfil_id'];

        echo $Empleado->create($nombre, $user, $pwd, $perfil_id);

    break;

    case 'perfiles':
        echo $Empleado->perfiles();
    break;
}