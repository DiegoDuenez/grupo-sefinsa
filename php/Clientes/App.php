<?php

require 'Cliente.php';
require '../FileManager.php';


$_DATA = json_decode(file_get_contents('php://input'), true);


/**
 * Datos enviados con formato json
 */
if(isset($_DATA['func'])){
    $func = $_DATA['func'];
}

/**
 * Datos enviados con formato form
 */
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


    /**
     * Funcion para crear un prestamo seleccionando la opción de cliente existente en el modal
     */
    case 'createPrestamoClienteExistente':

        $cliente_id = $_POST['cliente_id'];
        $direccion_cliente = $_POST['direccion_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $colocadora_id = $_POST['colocadora_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        $cantidad_archivos_cliente = $_POST['cantidad_archivos_cliente'];
        $cliente = $Cliente->getCliente($cliente_id);

        $nombre_aval = sanitize($_POST['nombre_aval']);
        $direccion_aval = sanitize($_POST['direccion_aval']);
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];
        $cantidad_archivos_aval = $_POST['cantidad_archivos_aval'];


        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];
        $tarjeton = $_POST['tarjeton'];


        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);
        FileManager::createFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);

        if($cantidad_archivos_garantias_aval > 0){
            for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
                $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
            }
        }

        if($cantidad_archivos_garantias_cliente > 0){
            for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
                $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
                FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
            }
        }


        if($cantidad_archivos_cliente > 0){
        
            for($i = 0; $i < $cantidad_archivos_cliente; $i++){
                $ruta_comprobantes_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'].'/';
                FileManager::moveTo(FileManager::get('archivo_cliente_'.$i,'tmp_name'), $ruta_comprobantes_cliente.FileManager::get('archivo_cliente_'.$i,'name'));
            }
                
        }
        
        if($cantidad_archivos_aval > 0){
        
            for($i = 0; $i < $cantidad_archivos_aval; $i++){
                $ruta_comprobantes_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('archivo_aval_'.$i,'tmp_name'), $ruta_comprobantes_aval.FileManager::get('archivo_aval_'.$i,'name'));
            }

        }

        echo $Cliente->createPrestamoClienteExistente($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, 
        $nueva_carpeta_aval, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses, $tarjeton);

    break;


    /**
     * Funcion para crear un prestamo cuando se crea un cliente y se marca la opcion de si cuando se pregunta si quiere generarse un prestamoa a ese cliente 
     * Lo de URI es porque al dar en la opcion de si este se redirecciona al modulo de prestamos y se abre el modal automaticamente
     */
    case 'createPrestamoClienteExistenteURI':

        $cliente_id = $_POST['cliente_id'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        $cantidad_archivos_cliente = $_POST['cantidad_archivos_cliente'];
        $cliente = $Cliente->getCliente($cliente_id);

        $nombre_aval = sanitize($_POST['nombre_aval']);
        $direccion_aval = sanitize($_POST['direccion_aval']);
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $garantias_cliente = $_POST['garantias_cliente'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];
        $cantidad_archivos_aval = $_POST['cantidad_archivos_aval'];

        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];
        $tarjeton = $_POST['tarjeton'];


        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);
        FileManager::createFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);

        if($cantidad_archivos_garantias_aval > 0){

            for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
                $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
            }

        }

        if($cantidad_archivos_garantias_cliente > 0){

            for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
                $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
                FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
            }

        }

        if($cantidad_archivos_cliente > 0){
        
            for($i = 0; $i < $cantidad_archivos_cliente; $i++){
                $ruta_comprobantes_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'].'/';
                FileManager::moveTo(FileManager::get('archivo_cliente_'.$i,'tmp_name'), $ruta_comprobantes_cliente.FileManager::get('archivo_cliente_'.$i,'name'));
            }
                
        }
        
        if($cantidad_archivos_aval > 0){
        
            for($i = 0; $i < $cantidad_archivos_aval; $i++){
                $ruta_comprobantes_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('archivo_aval_'.$i,'tmp_name'), $ruta_comprobantes_aval.FileManager::get('archivo_aval_'.$i,'name'));
            }

        }

        echo $Cliente->createPrestamoClienteExistenteURI($cliente_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, 
        $nueva_carpeta_aval, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses, $tarjeton);

    break;


    /**
     * Funcion para crear un prestamo seleccionando la opción de nuevo cliente
     */
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
        $cantidad_archivos_cliente = $_POST['cantidad_archivos_cliente'];

        
        $nombre_aval = $_POST['nombre_aval'];
        $direccion_aval = $_POST['direccion_aval'];
        $telefono_aval = $_POST['telefono_aval'];
        $or_aval = $_POST['or_aval'];
        $colocadora_id = $_POST['colocadora_id'];
        $garantias_aval = $_POST['garantias_aval'];
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];
        $cantidad_archivos_aval = $_POST['cantidad_archivos_aval'];

        $monto_prestado = $_POST['monto_prestado'];
        $monto_prestado_intereses = $_POST['monto_prestado_intereses'];
        $pago_semanal = $_POST['pago_semanal'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $modalidad_semanas = $_POST['modalidad_semanas'];
        $tarjeton = $_POST['tarjeton'];


        $nueva_carpeta_cliente  =  $Cliente->lastIdBeforeInsert('clientes') . '_'.$nombre_cliente;
        $nueva_carpeta_aval  =  $Cliente->lastIdBeforeInsert('avales') . '_'.$nombre_aval;

        FileManager::createFolder('../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente);
        FileManager::createFolder('../../resources/comprobantes/avales/'.$nueva_carpeta_aval);

        FileManager::createFolder('../../resources/garantias/clientes/'.$nueva_carpeta_cliente);
        FileManager::createFolder('../../resources/garantias/avales/'.$nueva_carpeta_aval);

       
        if($cantidad_archivos_garantias_aval > 0){

            for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
                $ruta_garantias_aval =  '../../resources/garantias/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
            }
        }

        if($cantidad_archivos_garantias_cliente > 0){

            for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
                $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$nueva_carpeta_cliente.'/';
                FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
            }
        }


        if($cantidad_archivos_cliente > 0){
        
            for($i = 0; $i < $cantidad_archivos_cliente; $i++){
                $ruta_comprobantes_cliente =  '../../resources/comprobantes/clientes/'.$nueva_carpeta_cliente.'/';
                FileManager::moveTo(FileManager::get('archivo_cliente_'.$i,'tmp_name'), $ruta_comprobantes_cliente.FileManager::get('archivo_cliente_'.$i,'name'));
            }
                
        }
        
        if($cantidad_archivos_aval > 0){
        
            for($i = 0; $i < $cantidad_archivos_aval; $i++){
                $ruta_comprobantes_aval =  '../../resources/comprobantes/avales/'.$nueva_carpeta_aval.'/';
                FileManager::moveTo(FileManager::get('archivo_aval_'.$i,'tmp_name'), $ruta_comprobantes_aval.FileManager::get('archivo_aval_'.$i,'name'));
            }

        }

        echo $Cliente->createPrestamoNuevo($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $nueva_carpeta_cliente,
        $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $nueva_carpeta_aval, $colocadora_id, $garantias_cliente, 
        $garantias_aval, $ruta_id, $poblacion_id, $nueva_carpeta_cliente, $nueva_carpeta_aval, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad_semanas, $monto_prestado_intereses, $tarjeton);

        
    break;


    /**
     * Funcion para crear un cliente
     */
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

        echo $Cliente->registrar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente,
        $ruta_id, $poblacion_id, $nueva_carpeta_cliente, $nueva_carpeta_cliente);
       
    break;


    /**
     * Funcion para editar un cliente y sus archivos
     */
    case 'edit':

        $nombre_cliente = sanitize($_POST['nombre_cliente']);
        $direccion_cliente = sanitize($_POST['direccion_cliente']);
        $telefono_cliente = sanitize($_POST['telefono_cliente']);
        $or_cliente = sanitize($_POST['or_cliente']);
        $colocadora_id = $_POST['colocadora_id'];
        $ruta_id = $_POST['ruta_id'];
        $poblacion_id = $_POST['poblacion_id'];
        $cliente_id = $_POST['cliente_id'];
        $cantidad_archivos_garantias_cliente = $_POST['cantidad_archivos_garantias_cliente'];
        $cantidad_archivos_cliente = $_POST['cantidad_archivos_cliente'];
        $cliente = $Cliente->getCliente($cliente_id);
        $cantidad_archivos_garantias_aval = $_POST['cantidad_archivos_garantias_aval'];
        $cantidad_archivos_aval = $_POST['cantidad_archivos_aval'];
        $aval = $Cliente->getAvalCliente($cliente_id);


        $ruta = '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'];
        if($cantidad_archivos_garantias_cliente > 0){

            if(FileManager::folderExist('../../resources/garantias/clientes/'.$cliente['carpeta_garantias'])){

                FileManager::dropFiles('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);

                for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
                    $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
                    FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
                }
    
            }
            else{
                FileManager::createFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias']);
                
                for($i = 0; $i < $cantidad_archivos_garantias_cliente; $i++){
                    $ruta_garantias_cliente =  '../../resources/garantias/clientes/'.$cliente['carpeta_garantias'].'/';
                    FileManager::moveTo(FileManager::get('garantia_cliente_'.$i,'tmp_name'), $ruta_garantias_cliente.FileManager::get('garantia_cliente_'.$i,'name'));
                }
            }

        }

        if($cantidad_archivos_cliente > 0){

            if(FileManager::folderExist('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'])){


                FileManager::dropFiles('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);

                for($i = 0; $i < $cantidad_archivos_cliente; $i++){
                    $ruta_comprobantes_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_garantias'].'/';
                    FileManager::moveTo(FileManager::get('archivo_cliente_'.$i,'tmp_name'), $ruta_comprobantes_cliente.FileManager::get('archivo_cliente_'.$i,'name'));
                }
    
            }
            else{
                FileManager::createFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes']);
                
                for($i = 0; $i < $cantidad_archivos_cliente; $i++){
                    $ruta_comprobantes_cliente =  '../../resources/comprobantes/clientes/'.$cliente['carpeta_garantias'].'/';
                    FileManager::moveTo(FileManager::get('archivo_cliente_'.$i,'tmp_name'), $ruta_comprobantes_cliente.FileManager::get('archivo_cliente_'.$i,'name'));
                }
            }

        }

        if($aval){

            if($cantidad_archivos_garantias_aval > 0){
            
                if(FileManager::folderExist('../../resources/garantias/avales/'.$aval['carpeta_garantias'])){
        
                    FileManager::dropFiles('../../resources/comprobantes/avales/'.$aval['carpeta_garantias']);

                    for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
                        $ruta_garantias_aval =  '../../resources/garantias/avales/'.$aval['carpeta_garantias'].'/';
                        FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
                    }
                    
                }
                else{
                    FileManager::createFolder('../../resources/garantias/avales/'.$aval['carpeta_garantias']);
                    
                    for($i = 0; $i < $cantidad_archivos_garantias_aval; $i++){
                        $ruta_garantias_aval =  '../../resources/garantias/avales/'.$aval['carpeta_garantias'].'/';
                        FileManager::moveTo(FileManager::get('garantia_aval_'.$i,'tmp_name'), $ruta_garantias_aval.FileManager::get('garantia_aval_'.$i,'name'));
                    }
                }

            }

            
            if($cantidad_archivos_aval > 0){
            
        
                if(FileManager::folderExist('../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes'])){

                    FileManager::dropFiles('../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes']);

                    for($i = 0; $i < $cantidad_archivos_aval; $i++){
                        $ruta_comprobantes_aval =  '../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes'].'/';
                        FileManager::moveTo(FileManager::get('archivo_aval_'.$i,'tmp_name'), $ruta_comprobantes_aval.FileManager::get('archivo_aval_'.$i,'name'));
                    }
                    
                }
                else{

                    FileManager::createFolder('../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes']);
                    
                    for($i = 0; $i < $cantidad_archivos_aval; $i++){
                        $ruta_comprobantes_aval =  '../../resources/comprobantes/avales/'.$aval['carpeta_comprobantes'].'/';
                        FileManager::moveTo(FileManager::get('archivo_aval_'.$i,'tmp_name'), $ruta_comprobantes_aval.FileManager::get('archivo_aval_'.$i,'name'));
                    }
                }

            }

        }

        

        echo $Cliente->editar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $ruta_id,$poblacion_id, $cliente_id);

        FileManager::renameFolder('../../resources/comprobantes/clientes/'.$cliente['carpeta_comprobantes'], '../../resources/comprobantes/clientes/'.$cliente_id.'_'.$nombre_cliente);
        FileManager::renameFolder('../../resources/garantias/clientes/'.$cliente['carpeta_garantias'], '../../resources/garantias/clientes/'.$cliente_id.'_'.$nombre_cliente);

       
        

    break;



    default:
        echo notDefine();
    break;


    

}