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

        $user = $_DATA['usuario'];
        $nombre = $_DATA['nombre_completo'];
        $pwd = $_DATA['password'];

        echo $Usuario->create($nombre, $user, $pwd);

    break;

    case 'login':

        $user = $_DATA['usuario'];
        $pwd = $_DATA['password'];

        echo $Usuario->login($user, $pwd);

    break;

    case 'edit':

        $user = $_DATA['usuario'];
        $nombre = $_DATA['nombre_completo'];
        $id = $_DATA['id'];
        $pwd = null;
        $changePassword = $_DATA['changePassword'];
        if($changePassword){
            $pwd = $_DATA['password'];
        }

        echo $Usuario->edit($nombre, $user, $pwd, $id, $changePassword);

    break;

    
    case 'activar':

        $id = $_DATA['id'];
        echo $Usuario->activar($id);

    break;

    case 'desactivar':

        $id = $_DATA['id'];
        echo $Usuario->desactivar($id);

    break;

}