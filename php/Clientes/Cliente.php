<?php

include '../database.php';
include '../response.php';

class Cliente extends Database{

    private $table = 'clientes';

    public function index()
    {

        $query  = "SELECT 
        $this->table.*,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        /*LEFT JOIN avales ON $this->table.aval_id = avales.id*/
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
 

    }

    public function traerCliente($id)
    {

        $query = "SELECT $this->table.*,
        colocadoras.nombre_completo as 'nombre_colocadora',
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion
        FROM $this->table
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE $this->table.id = '$id'
        ";

        return json(
            [
                'status' => 'success',
                'data' => $this->SelectOne($query),
                'message' => ''
            ]
        , 200);

    }

    public function clientesRuta($id){

        $query  = "SELECT 
        $this->table.*,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE rutas.id= '$id'
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function clientesPoblacion($id){

        $query  = "SELECT 
        $this->table.*,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE poblaciones.id= '$id'
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function clientesColocadora($id){

        $query  = "SELECT 
        $this->table.*,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE $this->table.colocadora_id = '$id'
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function lastIdBeforeInsert($table){

        $env = require '../env.php';
        $query = "SELECT AUTO_INCREMENT
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = '" .$env['database'] ."' AND  TABLE_NAME   = '$table'";

        $result = $this->SelectOne($query);

        return $result['AUTO_INCREMENT'];
               
    }

    public function avalCliente($id)
    {

        $query  = "SELECT avales.* FROM $this->table 
        LEFT JOIN avales ON $this->table.aval_id = avales.id
        WHERE $this->table.id = '$id'
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

 

    public function garantiasCliente($id){

        $query  = "SELECT garantias.nombre_garantia, garantias.urL_imagen
        FROM $this->table 
        INNER JOIN garantias ON $this->table.id = garantias.cliente_idc
        WHERE garantias.cliente_id = '$id'
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function garantiasAval($id){

        $query  = "SELECT garantias.nombre_garantia, garantias.urL_imagen
        FROM avales 
        INNER JOIN garantias ON avales.id = garantias.aval_id
        WHERE garantias.aval_id = '$id'
        ORDER BY avales.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }


    public function create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $carpeta_comp_cliente, $nombre_aval, 
        $direccion_aval, $telefono_aval, $or_aval, $carpeta_comp_aval, $colocadora_id, $garantias_cliente, $garantias_aval, $ruta_id, $poblacion_id, $carpeta_gar_cliente, $carpeta_gar_aval){

            try{

                $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, garantias, carpeta_comprobantes, carpeta_garantias) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, $carpeta_comp_aval, $carpeta_gar_aval]);
    
                if($aval) {
    
                    $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias, aval_id,  colocadora_id, garantias, ruta_id, poblacion_id, carpeta_comprobantes, carpeta_garantias) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $this->lastId(),$colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $carpeta_comp_cliente, $carpeta_gar_cliente]);
    
                    if($cliente){
                        return json([
                            'status' => 'success', 
                            'data'=> null, 
                            'message'=> 'Se ha creado al cliente'
                        ], 200);
                    }
                
    
                } else {
    
                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear al cliente'
                    ], 400);
    
                }
    
            } catch(Exception $e) {
    
                return $e->getMessage();
                die();
    
            }

    }


    public function registrar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $carpeta_comp_cliente, $carpeta_gar_cliente)
    {

        try{


                $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias, colocadora_id, garantias, ruta_id, poblacion_id, carpeta_comprobantes, carpeta_garantias) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $carpeta_comp_cliente, $carpeta_gar_cliente]);

                if($cliente){
                    return json([
                        'status' => 'success', 
                        'data'=> ['id' => $this->lastId()], 
                        'message'=> 'Se ha creado al cliente'
                    ], 200);
                }
                else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear al cliente'
                    ], 400);

                }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function editar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $ruta_id, $poblacion_id, $cliente_id)
    {
        $updateCliente = "UPDATE clientes SET nombre_completo = ?, direccion = ?, telefono = ?, otras_referencias = ?, colocadora_id = ?, ruta_id = ?, poblacion_id = ?,
                carpeta_comprobantes = ?, carpeta_garantias = ?
                WHERE id = '$cliente_id'";
                $cliente = $this->ExecuteQuery($updateCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente,  $colocadora_id, $ruta_id, $poblacion_id, $cliente_id.'_'.$nombre_cliente, $cliente_id.'_'.$nombre_cliente]);


                if($cliente){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado al cliente'
                    ], 200);
                }
                else{
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'No se actualizo nada nuevo'
                    ], 200);
                }
    }


    public function createConAval($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $carpeta_comp_cliente, $nombre_aval, 
    $direccion_aval, $telefono_aval, $or_aval, $carpeta_comp_aval, $colocadora_id, $garantias_cliente, $garantias_aval, $ruta_id, $poblacion_id, $carpeta_gar_cliente, $carpeta_gar_aval,
    $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad){

        require '../Prestamos/Prestamo.php';

        try{

            $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, garantias, carpeta_comprobantes, carpeta_garantias) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, $carpeta_comp_aval, $carpeta_gar_aval]);

            if($aval) {

                $aval_id = $this->lastId();

                $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias,  colocadora_id, garantias, ruta_id, poblacion_id, carpeta_comprobantes, carpeta_garantias) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $carpeta_comp_cliente, $carpeta_gar_cliente]);

                if($cliente){

                    $cliente_id = $this->lastId();
                    $Prestamo = new Prestamo();
                    $Prestamo->create($cliente_id, $direccion_cliente, $telefono_cliente,  $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad);
                   

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado al cliente'
                    ], 200);
                }
            

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear al cliente'
                ], 400);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }


    }

    public function getCliente($id){

        
        $query  = "SELECT 
        $this->table.*,  
        $this->table.otras_referencias,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE $this->table.id = '$id'";

        $cliente = $this->SelectOne($query);

        return $cliente;

    }

    public function getAvalCliente($id)
    {
        $query  = "SELECT 
        avales.*
        FROM avales
        INNER JOIN prestamos ON avales.id = prestamos.aval_id
        INNER JOIN $this->table ON $this->table.id = prestamos.cliente_id
        WHERE prestamos.cliente_id = '$id'
        ORDER BY prestamos.id DESC
        LIMIT 1
        ";

        $aval = $this->SelectOne($query);

        return $aval;   
    }

    public function getAval($id){

        $query  = "SELECT avales.* FROM avales WHERE avales.id = '$id'";

        $aval = $this->SelectOne($query);

        return $aval;

    }

    public function createPrestamoClienteExistente($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval,  $carpeta_comp_aval, $carpeta_gar_aval,
    $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad){

        require '../Prestamos/Prestamo.php';

        try{

            $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, garantias, carpeta_comprobantes, carpeta_garantias) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, $carpeta_comp_aval, $carpeta_gar_aval]);

            if($aval) {

                $aval_id = $this->lastId();

                $updateCliente = "UPDATE $this->table SET direccion = ?, telefono = ?, garantias = ?, ruta_id = ?, poblacion_id = ?, colocadora_id = ? 
                WHERE $this->table.id = '$cliente_id' ";
                $cliente = $this->ExecuteQuery($updateCliente, [$direccion_cliente, $telefono_cliente, $garantias_cliente, $ruta_id, $poblacion_id, $colocadora_id]);


                $Prestamo = new Prestamo();
                $Prestamo->create($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad);
                
                //$Prestamo->create($cliente_id, $monto_prestado, $pago_semanal, $fecha_prestamo);
            

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear al cliente'
                ], 400);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function createPrestamoClienteExistenteURI($cliente_id, $garantias_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval,  $carpeta_comp_aval, $carpeta_gar_aval,
    $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad){

        require '../Prestamos/Prestamo.php';

        try{

            $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, garantias, carpeta_comprobantes, carpeta_garantias) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, $carpeta_comp_aval, $carpeta_gar_aval]);

            if($aval) {

                $aval_id = $this->lastId();

                $updateCliente = "UPDATE $this->table SET garantias = ? WHERE $this->table.id = '$cliente_id' ";
                $cliente = $this->ExecuteQuery($updateCliente, [$garantias_cliente]);

                $clienteArray = $this->getCliente($cliente_id);

                $Prestamo = new Prestamo();
                $Prestamo->create($cliente_id, $clienteArray['direccion'], $clienteArray['telefono'], $clienteArray['ruta_id'], $clienteArray['poblacion_id'], $clienteArray['colocadora_id'], $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad);
                
            

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear al cliente'
                ], 400);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    
   /* public function edit($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $nombre_aval, 
    $direccion_aval, $telefono_aval, $or_aval, $colocadora_id, $garantias_cliente, $garantias_aval, $cliente_id, $aval_id, $ruta_id, $poblacion_id){

        try{

            $updateAval = "UPDATE avales SET nombre_completo = ?, direccion = ?, telefono = ?, otras_referencias = ?, garantias = ?, 
            carpeta_comprobantes = ?, carpeta_garantias = ?
            WHERE id = '$aval_id'";
            $aval = $this->ExecuteQuery($updateAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $garantias_aval, $aval_id.'_'.$nombre_aval, $aval_id.'_'.$nombre_aval]);


            if($aval) {

                $updateCliente = "UPDATE clientes SET nombre_completo = ?, direccion = ?, telefono = ?, otras_referencias = ?, garantias = ?, colocadora_id = ?, ruta_id = ?, poblacion_id = ?,
                carpeta_comprobantes = ?, carpeta_garantias = ?
                WHERE id = '$cliente_id'";
                $cliente = $this->ExecuteQuery($updateCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $garantias_cliente, $colocadora_id, $ruta_id, $poblacion_id, $cliente_id.'_'.$nombre_cliente, $cliente_id.'_'.$nombre_cliente]);


                if($cliente){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado al cliente'
                    ], 200);
                }
            

            } else {

                $updateCliente = "UPDATE clientes SET nombre_completo = ?, direccion = ?, telefono = ?, otras_referencias = ?, garantias = ?, colocadora_id = ?, ruta_id = ?, poblacion_id = ?,
                carpeta_comprobantes = ?, carpeta_garantias = ?
                WHERE id = '$cliente_id'";
                $cliente = $this->ExecuteQuery($updateCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $garantias_cliente, $colocadora_id, $ruta_id, $poblacion_id, $cliente_id.'_'.$nombre_cliente, $cliente_id.'_'.$nombre_cliente]);
                
                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'No se actualizo nada nuevo'
                ], 200);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }


    }*/

}