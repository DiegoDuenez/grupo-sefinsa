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

    case 'clientesRuta':
        $id = $_DATA['ruta_id'];
        echo $Cliente->clientesRuta($id);
    break;    

    case 'clientesPoblacion':
        $id = $_DATA['poblacion_id'];
        echo $Cliente->clientesPoblacion($id);
    break;   

    case 'clientesColocadora':
        $id = $_DATA['colocadora_id'];
        echo $Cliente->clientesColocadora($id);
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
        $colocadora_id = $_POST['colocadora_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];
        $garantias_cliente = $_POST['garantias_cliente'];
        
        $nombre_aval = $_POST['nombre_aval'];
        $direccion_aval = $_POST['direccion_aval'];
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $colocadora_id = $_POST['colocadora_id'];
        $garantias_aval = $_POST['garantias_aval'];


        
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


        echo $Cliente->create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $nueva_carpeta_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $nueva_carpeta_aval, $colocadora_id, $garantias_cliente, 
        $garantias_aval, $ruta_id, $poblacion_id, $nueva_carpeta_cliente, $nueva_carpeta_aval);

        
    break;


    case 'edit':

        $nombre_cliente = $_POST['nombre_cliente'];
        $direccion_cliente = $_POST['direccion_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $or_cliente = $_POST['or_cliente'];
        $colocadora_id = $_POST['colocadora_id'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $cliente_id = $_POST['cliente_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];

        $nombre_aval = $_POST['nombre_aval'];
        $direccion_aval = $_POST['direccion_aval'];
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $colocadora_id = $_POST['colocadora_id'];
        $garantias_aval = $_POST['garantias_aval'];
        $aval_id = $_POST['aval_id'];


        $cliente = $Cliente->getCliente($cliente_id);
        $aval = $Cliente->getAval($aval_id);

        FileManager::renameFolder('../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes'], '../../resources/comprobantes/avales/'.$aval_id.'_'.$nombre_aval);
        FileManager::renameFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'], '../../resources/comprobantes/clientes/'.$cliente_id.'_'.$nombre_cliente);

        echo $Cliente->edit($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $colocadora_id, $garantias_cliente, $garantias_aval, $cliente_id, $aval_id, $ruta_id, $poblacion_id);
    
    break;


    default:
        echo notDefine();
    break;


    

}