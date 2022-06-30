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
        avales.id as 'aval_id', 
        avales.nombre_completo as 'nombre_aval',
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', 
        avales.otras_referencias as 'or_aval',
        avales.garantias as 'garantias_aval',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        LEFT JOIN avales ON $this->table.aval_id = avales.id
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

    public function clientesRuta($id){

        $query  = "SELECT 
        $this->table.*,  
        $this->table.ruta_id as 'ruta_cliente', 
        $this->table.poblacion_id as 'poblacion_cliente',
        $this->table.ruta_id  as 'ruta_cliente',
        avales.id as 'aval_id', 
        avales.nombre_completo as 'nombre_aval',
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', 
        avales.otras_referencias as 'or_aval',
        avales.garantias as 'garantias_aval',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        LEFT JOIN avales ON $this->table.aval_id = avales.id
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
        avales.id as 'aval_id', 
        avales.nombre_completo as 'nombre_aval',
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', 
        avales.otras_referencias as 'or_aval',
        avales.garantias as 'garantias_aval',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        LEFT JOIN avales ON $this->table.aval_id = avales.id
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
        avales.id as 'aval_id', 
        avales.nombre_completo as 'nombre_aval',
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', 
        avales.otras_referencias as 'or_aval',
        avales.garantias as 'garantias_aval',
        colocadoras.id as 'colocadora_id', 
        colocadoras.nombre_completo as 'nombre_colocadora', 
        colocadoras.status as 'status_colocadora', 
        colocadoras.ruta_id as 'ruta_colocadora',
        colocadoras.poblacion_id as 'poblacion_colocadora',
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        LEFT JOIN avales ON $this->table.aval_id = avales.id
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


                $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias, aval_id,  colocadora_id, garantias, ruta_id, poblacion_id, carpeta_comprobantes, carpeta_garantias) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, null,$colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $carpeta_comp_cliente, $carpeta_gar_cliente]);

                if($cliente){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
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

    public function editar($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $colocadora_id, $garantias_cliente, $ruta_id, $poblacion_id, $cliente_id)
    {
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
                else{
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'No se actualizo nada nuevo'
                    ], 200);
                }
    }


    /*public function create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $carpeta_comp_cliente, $nombre_aval, 
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


    }*/

    public function getCliente($id){

        $query  = "SELECT $this->table.* FROM $this->table WHERE $this->table.id = '$id'";

        $cliente = $this->SelectOne($query);

        return $cliente;

    }

    public function getAval($id){

        $query  = "SELECT avales.* FROM avales WHERE avales.id = '$id'";

        $aval = $this->SelectOne($query);

        return $aval;

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