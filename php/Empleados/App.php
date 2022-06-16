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

    case 'edit':

        $user = $_DATA['usuario'];
        $nombre = $_DATA['nombre_completo'];
        $id = $_DATA['id'];
        $perfil_id = $_DATA['perfil_id'];
        $pwd = null;
        $changePassword = $_DATA['changePassword'];
        if($changePassword){
            $pwd = $_DATA['password'];
        }

        echo $Empleado->edit($nombre, $user, $pwd, $perfil_id, $id, $changePassword);

    break;

    
    case 'activar':

        $id = $_DATA['id'];
        echo $Empleado->activar($id);

    break;

    case 'desactivar':

        $id = $_DATA['id'];
        echo $Empleado->desactivar($id);

    break;

    default:
        echo notDefine();
    break;
}