<?php

require 'Perfil.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];

$Perfil = new Perfil;

switch($func){

    case 'index':
        echo $Perfil->index();
    break;
    
    case 'create':
        $nombre_perfil = $_DATA['nombre_perfil'];
        $tipo_perfil = $_DATA['tipo_perfil'];
        $modulos = $_DATA['modulos'];
        echo $Perfil->create($nombre_perfil, $tipo_perfil, $modulos);
    break;

    case 'edit':
        $id = $_DATA['id'];
        $nombre_perfil = $_DATA['nombre_perfil'];
        $tipo_perfil = $_DATA['tipo_perfil'];
        $modulos = $_DATA['modulos'];
        echo $Perfil->edit($id, $nombre_perfil, $tipo_perfil, $modulos);
    break;
}