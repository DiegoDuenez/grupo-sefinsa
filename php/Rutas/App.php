<?php

require 'Ruta.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Ruta = new Ruta;

switch($func){

    case 'index':
        echo $Ruta->index();
    break;

    case 'rutasActivas':
        echo $Ruta->rutasActivas();
    break;

    case 'create':
        
        $nombre = $_DATA['nombre_ruta'];
        $empleados = $_DATA['empleados'];
        echo $Ruta->create($nombre, $empleados);
        
    break;

    case 'edit':
        $id = $_DATA['id'];
        $nombre = $_DATA['nombre_ruta'];
        $empleados = $_DATA['empleados'];
        echo $Ruta->edit($nombre, $empleados, $id);
    break;

    case 'localidadesRuta':
        $id = $_DATA['id'];
        echo $Ruta->localidadesRuta($id);
    break;

    case 'activar':
        $id = $_DATA['id'];
        echo $Ruta->activar($id);
    break;

    case 'desactivar':
        $id = $_DATA['id'];
        echo $Ruta->desactivar($id);
    break;

    default:
        echo notDefine();
    break;

}