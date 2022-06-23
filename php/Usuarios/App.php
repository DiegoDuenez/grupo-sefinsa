<?php

require 'Usuario.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Usuario = new Usuario;

switch($func){

    case 'index':
        echo $Usuario->index();
    break;

    case 'create':

        $user = sanitize($_DATA['usuario']);
        $nombre = sanitize($_DATA['nombre_completo']);
        $pwd = sanitize($_DATA['password']);
        $perfil_id = $_DATA['perfil_id'];

        echo $Usuario->create($nombre, $user, $pwd, $perfil_id);

    break;

    case 'login':

        $user = $_DATA['usuario'];
        $pwd = $_DATA['password'];

        echo $Usuario->login($user, $pwd);

    break;

    case 'edit':

        $user = sanitize($_DATA['usuario']);
        $nombre = sanitize($_DATA['nombre_completo']);
        $id = $_DATA['id'];
        $pwd = null;
        $perfil_id = $_DATA['perfil_id'];
        $changePassword = $_DATA['changePassword'];
        if($changePassword){
            $pwd = $_DATA['password'];
        }

        echo $Usuario->edit($nombre, $user, $pwd, $id, $changePassword, $perfil_id);

    break;

    
    case 'activar':

        $id = $_DATA['id'];
        echo $Usuario->activar($id);

    break;

    case 'desactivar':

        $id = $_DATA['id'];
        echo $Usuario->desactivar($id);

    break;

    default:
        echo notDefine();
    break;

}