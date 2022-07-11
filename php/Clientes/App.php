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

    case 'comprobantesCliente':
            
        $id = $_DATA['id'];
        $cliente = $Cliente->getCliente($id);
        $path = "../../resources/comprobantes/clientes/".$cliente['carpeta_comprobantes'];

        if(FileManager::getFiles($path)){

            echo json([
                'status'=>'success',
                'data'=> FileManager::getFiles($path),
                'message'=>''
            ], 200);

        }
        else{

            echo json([
                'status'=>'error',
                'data'=> "La ruta $path no fue encontrada.",
                'message'=>''
            ], 404);

        }
        

    break;

    case 'comprobantesAval':

        $id = $_DATA['id'];
        $aval = $Cliente->getAval($id);
        $path = "../../resources/comprobantes/avales/".$aval['carpeta_comprobantes'];

        if(FileManager::getFiles($path)){

            echo json([
                'status'=>'success',
                'data'=> FileManager::getFiles($path),
                'message'=>''
            ], 200);

        }
        else{

            echo json([
                'status'=>'error',
                'data'=> "La ruta $path no fue encontrada.",
                'message'=>''
            ], 404);

        }

    break;

    case 'garantiasCliente':
            
        $id = $_DATA['id'];
        $cliente = $Cliente->getCliente($id);
        $path = "../../resources/garantias/clientes/".$cliente['carpeta_garantias'];

        if(FileManager::getFiles($path)){

            echo json([
                'status'=>'success',
                'data'=> FileManager::getFiles($path),
                'message'=>''
            ], 200);

        }
        else{

            echo json([
                'status'=>'error',
                'data'=> "La ruta $path no fue encontrada.",
                'message'=>''
            ], 404);

        }
        

    break;

    case 'traerCliente':

        $id = $_DATA['id'];

        echo $Cliente->traerCliente($id);

    break;

    case 'garantiasAval':

        $id = $_DATA['id'];
        $aval = $Cliente->getAval($id);
        $path = "../../resources/garantias/avales/".$aval['carpeta_garantias'];

        if(FileManager::getFiles($path)){

            echo json([
                'status'=>'success',
                'data'=> FileManager::getFiles($path),
                'message'=>''
            ], 200);

        }
        else{

            echo json([
                'status'=>'error',
                'data'=> "La ruta $path no fue encontrada.",
                'message'=>''
            ], 404);

        }

    break;


    case 'createPrestamoClienteExistente':

        $cliente_id = $_POST['cliente_id'];
        $direccion_cliente = $_POST['direccion_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $colocadora_id = $_POST['colocadora_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        $cliente = $Cliente->getCliente($cliente_id);

        $nombre_aval = sanitize($_POST['nombre_aval']);
        $direccion_aval = sanitize($_POST['direccion_aval']);
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];

        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];

        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);
        FileManager::createFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);

        for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
            $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
            FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
        }
        for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
            $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
            FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
        }

        $ruta_archivos_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'].'/';
        FileManager::moveTo(FileManager::get('archivo_cliente_0','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_0','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_1','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_1','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_2','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_2','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_3','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_3','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_4','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_4','name'));

        $ruta_archivos_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
        FileManager::moveTo(FileManager::get('archivo_aval_0','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_0','name'));
        FileManager::moveTo(FileManager::get('archivo_aval_1','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_1','name'));

        echo $Cliente->createPrestamoClienteExistente($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, 
        $nueva_carpeta_aval, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses);

    break;

    case 'createPrestamoClienteExistenteURI':

        $cliente_id = $_POST['cliente_id'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        $cliente = $Cliente->getCliente($cliente_id);

        $nombre_aval = sanitize($_POST['nombre_aval']);
        $direccion_aval = sanitize($_POST['direccion_aval']);
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];

        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];


        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);
        FileManager::createFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);

        for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
            $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
            FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
        }
        for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
            $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
            FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
        }

        $ruta_archivos_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'].'/';
        FileManager::moveTo(FileManager::get('archivo_cliente_0','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_0','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_1','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_1','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_2','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_2','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_3','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_3','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_4','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_4','name'));

        $ruta_archivos_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
        FileManager::moveTo(FileManager::get('archivo_aval_0','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_0','name'));
        FileManager::moveTo(FileManager::get('archivo_aval_1','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_1','name'));

        echo $Cliente->createPrestamoClienteExistenteURI($cliente_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, 
        $nueva_carpeta_aval, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses);

    break;

    case 'createPrestamoNuevoCliente':

        
        $nombre_cliente = $_POST['nombre_cliente'];
        $direccion_cliente = $_POST['direccion_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $or_cliente = $_POST['or_cliente'];
        $colocadora_id = $_POST['colocadora_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        
        $nombre_aval = $_POST['nombre_aval'];
        $direccion_aval = $_POST['direccion_aval'];
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $colocadora_id = $_POST['colocadora_id'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];

        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];

        $nueva_carpeta_cliente  =  $Cliente->lastIdBeforeInsert('clientes') . '_'.$nombre_cliente;
        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente);
        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/garantias/clientes/'.$nueva_carpeta_cliente);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

       
        for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
            $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
            FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
        }

        for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
            $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$nueva_carpeta_cliente.'/';
            FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
        }

        $ruta_archivos_cliente =  '../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente.'/';
        FileManager::moveTo(FileManager::get('archivo_cliente_0','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_0','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_1','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_1','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_2','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_2','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_3','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_3','name'));
        FileManager::moveTo(FileManager::get('archivo_cliente_4','tmp_name'), $ruta_archivos_cliente.FileManager::get('archivo_cliente_4','name'));

        $ruta_archivos_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
        FileManager::moveTo(FileManager::get('archivo_aval_0','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_0','name'));
        FileManager::moveTo(FileManager::get('archivo_aval_1','tmp_name'), $ruta_archivos_aval.FileManager::get('archivo_aval_1','name'));


        echo $Cliente->createConAval($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $nueva_carpeta_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $nueva_carpeta_aval, $colocadora_id, $garantias_cliente, 
        $garantias_aval, $ruta_id, $poblacion_id, $nueva_carpeta_cliente, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses);

        
    break;


    case 'create':

        $nombre_cliente = sanitize($_DATA['nombre_cliente']);
        $direccion_cliente = sanitize($_DATA['direccion_cliente']);
        $telefono_cliente = sanitize($_DATA['telefono_cliente']);
        $or_cliente = sanitize($_DATA['or_cliente']);
        $colocadora_id = $_DATA['colocadora_id'];
        $ruta_id = $_DATA['ruta_id'];
        $poblacion_id = $_DATA['poblacion_id'];
        $garantias_cliente = "";
        $nueva_carpeta_cliente  =  $Cliente->lastIdBeforeInsert('clientes') . '_'.$nombre_cliente;
        //$nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        echo $Cliente->registrar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente,
        $ruta_id, $poblacion_id, $nueva_carpeta_cliente, $nueva_carpeta_cliente);


    break;


    /*case 'edit':

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
       
        echo $Cliente->edit($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $colocadora_id, $garantias_cliente, $garantias_aval, $cliente_id, $aval_id, $ruta_id, $poblacion_id);
        
        FileManager::renameFolder('../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes'], '../../resources/comprobantes/avales/'.$aval_id.'_'.$nombre_aval);
        FileManager::renameFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'], '../../resources/comprobantes/clientes/'.$cliente_id.'_'.$nombre_cliente);
        FileManager::renameFolder('../../resources/garantias/avales/'.$aval['carpeta_garantias'], '../../resources/garantias/avales/'.$aval_id.'_'.$nombre_aval);
        FileManager::renameFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias'], '../../resources/garantias/clientes/'.$cliente_id.'_'.$nombre_cliente);


    break;*/

    case 'edit':

        $nombre_cliente = sanitize($_DATA['nombre_cliente']);
        $direccion_cliente = sanitize($_DATA['direccion_cliente']);
        $telefono_cliente = sanitize($_DATA['telefono_cliente']);
        $or_cliente = sanitize($_DATA['or_cliente']);
        $colocadora_id = $_DATA['colocadora_id'];
        $ruta_id = $_DATA['ruta_id'];
        $poblacion_id = $_DATA['poblacion_id'];
        //$garantias_cliente = sanitize($_DATA['garantias_cliente']);
        $cliente_id = $_DATA['cliente_id'];

        $cliente = $Cliente->getCliente($cliente_id);

        echo $Cliente->editar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $ruta_id,$poblacion_id, $cliente_id);

        FileManager::renameFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'], '../../resources/comprobantes/clientes/'.$cliente_id.'_'.$nombre_cliente);
        FileManager::renameFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias'], '../../resources/garantias/clientes/'.$cliente_id.'_'.$nombre_cliente);


    break;



    default:
        echo notDefine();
    break;


    

}