<?php


require 'Colocadora.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

$func = $_DATA['func'];
$Colocadora = new Colocadora;

switch($func){

    case 'index':
        echo $Colocadora->index();
    break;

    case 'create':

        $nombre = sanitize($_DATA['nombre_completo']);
        $direccion = sanitize($_DATA['direccion']);
        $telefono = sanitize($_DATA['telefono']);
        $ruta_id = $_DATA['ruta_id'];
        $poblacion_id = $_DATA['poblacion_id'];

        echo $Colocadora->create($nombre, $direccion, $telefono, $ruta_id, $poblacion_id);

    break;

    case 'edit':

        $nombre = sanitize($_DATA['nombre_completo']);
        $direccion = sanitize($_DATA['direccion']);
        $telefono = sanitize($_DATA['telefono']);
        $ruta_id = $_DATA['ruta_id'];
        $poblacion_id = $_DATA['poblacion_id'];
        $id = $_DATA['id'];

        echo $Colocadora->edit($nombre, $direccion, $telefono, $ruta_id, $poblacion_id, $id);
    break;

    case 'activar':
        $id = $_DATA['id'];
        echo $Colocadora->activar($id);
    break;

    case 'desactivar':
        $id = $_DATA['id'];
        echo $Colocadora->desactivar($id);
    break;

}