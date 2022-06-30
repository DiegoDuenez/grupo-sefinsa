<?php

require 'Empleado.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Empleado = new Empleado;

switch($func){

    case 'index':
        echo $Empleado->index();
    break;

    case 'empleadosActivos':
        echo $Empleado->empleadosActivos();
    break;

    case 'create':

        $nombre = sanitize($_DATA['nombre_completo']);
        $user = sanitize($_DATA['usuario']);
        $pwd = sanitize($_DATA['password']);
        $perfil_id = $_DATA['perfil_id'];

        echo $Empleado->create($nombre, $user, $pwd, $perfil_id);

    break;

    case 'perfiles':
        $tipo_perfil = $_DATA['tipo_perfil'];
        echo $Empleado->perfiles($tipo_perfil);
    break;

    case 'edit':

        $nombre = sanitize($_DATA['nombre_completo']);
        $user = sanitize($_DATA['usuario']);
        $id = $_DATA['id'];
        $perfil_id = $_DATA['perfil_id'];
        $pwd = null;
        $changePassword = $_DATA['changePassword'];

        if($changePassword){
            $pwd = sanitize($_DATA['password']);
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