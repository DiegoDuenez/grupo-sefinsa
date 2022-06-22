<?php


require 'Cliente.php';
require '../FileManager.php';

$_DATA = json_decode(file_get_contents('php://input'), true);

if(isset($_DATA['func'])){
    $func = $_DATA['func'];
}

if(isset($_POST['func'])){
    $func = $_POST['func'];
}

$Cliente = new Cliente;

switch($func){

    case 'index':
        echo $Cliente->index();
    break;

    case 'avalCliente':

        $id = $_DATA['id'];
        echo $Cliente->avalCliente($id);

    break;

    case 'comprobantesCliente':

        $id = $_DATA['id'];
        echo $Cliente->comprobantesCliente($id);

    break;

    case 'comprobantesAval':

        $id = $_DATA['id'];
        echo $Cliente->comprobantesAval($id);

    break;

    case 'garantiasCliente':

        $id = $_DATA['id'];
        echo $Cliente->garantiasCliente($id);

    break;

    case 'garantiasAval':

        $id = $_DATA['id'];
        echo $Cliente->garantiasAval($id);

    break;

    case 'create':

        /*if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], '../../resources/comprobantes/' . $_FILES['file']['name']);
            
        }*/

        if ( 0 < FileManager::errors('domicilio_cliente') || 0 < FileManager::errors('ine_cliente')  ) {
            echo FileManager::errors();
        }
        else {
            FileManager::moveTo(FileManager::get('domicilio_cliente','tmp_name'), '../../resources/comprobantes/'.FileManager::fileExtension(FileManager::get('domicilio_cliente','name')));
            FileManager::moveTo(FileManager::get('ine_cliente','tmp_name'), '../../resources/comprobantes/'.FileManager::get('ine_cliente','name'));

        }

        

    break;

    default:
        echo notDefine();
    break;


    

}