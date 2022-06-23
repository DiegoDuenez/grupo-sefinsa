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

    case 'garantiasCliente':

        $id = $_DATA['id'];
        echo $Cliente->garantiasCliente($id);

    break;

    case 'garantiasAval':

        $id = $_DATA['id'];
        echo $Cliente->garantiasAval($id);

    break;

    case 'create':

        
        $nombre_cliente = $_POST['nombre_cliente'];
        $direccion_cliente = $_POST['direccion_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $or_cliente = $_POST['or_cliente'];
        
        $nombre_aval = $_POST['nombre_aval'];
        $direccion_aval = $_POST['direccion_aval'];
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $colocadora_id = $_POST['colocadora_id'];

        
        $nueva_carpeta_cliente  =  $Cliente->lastIdBeforeInsert('clientes') . '_'.$nombre_cliente;
        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente);
        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);


        $ruta_archivos_cliente =  '../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente.'/';
        FileManager::moveTo(FileManager::get('archivo_cliente_0','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_0','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_1','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_1','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_2','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_2','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_3','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_3','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_4','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_4','name'));

        $ruta_archivos_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
        FileManager::moveTo(FileManager::get('archivo_aval_0','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_0','name'));
        FileManager::moveTo(FileManager::get('archivo_aval_1','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_1','name'));


        $archivos_cliente = "['$ruta_archivos_cliente". FileManager::get('archivo_cliente_0','name') . "', ".
        "'$ruta_archivos_cliente".FileManager::get('archivo_cliente_1','name') . "', ".
        "'$ruta_archivos_cliente".FileManager::get('archivo_cliente_2','name') . "', ".
        "'$ruta_archivos_cliente".FileManager::get('archivo_cliente_3','name') . "', ".
        "'$ruta_archivos_cliente".FileManager::get('archivo_cliente_4','name') . "', ".
        "]";

        $archivos_aval = "['$ruta_archivos_aval". FileManager::get('archivo_aval_0','name') . "', ".
        "'$ruta_archivos_aval".FileManager::get('archivo_aval_1','name') . "', ".
        "]";

        echo $Cliente->create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $archivos_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $archivos_aval, $colocadora_id);

        //FileManager::createFolder('../../resources/comprobantes/diego');

        //FileManager::renameFolder('../../resources/comprobantes/diego/', '../../resources/comprobantes/diego03');


       /* if ( 0 < FileManager::errors('domicilio_cliente') || 0 < FileManager::errors('ine_cliente')  ) {
            echo FileManager::errors('domicilio_cliente');
            die();
        }
        else {

            //FileManager::createFolder('../../resources/comprobantes/diego');

            $c_domicilio_cliente =  'resources/comprobantes/'.FileManager::get('domicilio_cliente','name');
            $c_ine_cliente =  'resources/comprobantes/'.FileManager::get('ine_cliente','name');
            $c_tarjeton_cliente =  'resources/comprobantes/'.FileManager::get('tarjeton_cliente','name');
            $c_contrato_cliente =  'resources/comprobantes/'.FileManager::get('contrato_cliente','name');
            $c_pagare_cliente =  'resources/comprobantes/'.FileManager::get('pagare_cliente','name');

            $c_domicilio_aval =  'resources/comprobantes/'.FileManager::get('domicilio_aval','name');
            $c_ine_aval =  'resources/comprobantes/'.FileManager::get('ine_aval','name');

            FileManager::moveTo(FileManager::get('domicilio_cliente','tmp_name'), '../../'.$c_domicilio_cliente);
            FileManager::moveTo(FileManager::get('ine_cliente','tmp_name'), '../../'.$c_ine_cliente);
            FileManager::moveTo(FileManager::get('tarjeton_cliente','tmp_name'), '../../'.$c_tarjeton_cliente);
            FileManager::moveTo(FileManager::get('contrato_cliente','tmp_name'), '../../'.$c_contrato_cliente);
            FileManager::moveTo(FileManager::get('pagare_cliente','tmp_name'), '../../'.$c_pagare_cliente);

            FileManager::moveTo(FileManager::get('domicilio_aval','tmp_name'), '../../'.$c_domicilio_aval);
            FileManager::moveTo(FileManager::get('ine_aval','tmp_name'), '../../'.$c_ine_aval);

            echo $Cliente->create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $c_domicilio_cliente, $c_ine_cliente, $c_tarjeton_cliente, $c_contrato_cliente, $c_pagare_cliente,
                            $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $c_domicilio_aval, $c_ine_aval);


        }*/

        
        
    break;

    default:
        echo notDefine();
    break;


    

}