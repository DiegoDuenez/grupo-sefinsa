<?php

include '../database.php';
include '../response.php';

class Cliente extends Database{

    private $table = 'clientes';

    public function index()
    {

       

        /*$query  = "SELECT $this->table.*, avales.id as 'aval_id', avales.nombre_completo as 'nombre_aval'
        FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
        ORDER BY $this->table.id DESC";*/

        
        $query  = "SELECT $this->table.*, avales.id as 'aval_id', avales.nombre_completo as 'nombre_aval',
        avales.direccion as 'direccion_aval', avales.telefono as 'telefono_aval', avales.otras_referencias as 'or_aval',
        avales.garantias as 'garantias_aval',
        colocadoras.id as 'colocadora_id', colocadoras.nombre_completo as 'nombre_colocadora', 
        rutas.id as 'ruta_id', rutas.nombre_ruta as 'nombre_ruta',
        poblaciones.id as 'poblacion_id', poblaciones.nombre_poblacion as 'nombre_poblacion' 
        FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
        INNER JOIN colocadoras ON $this->table.colocadora_id = colocadoras.id
        INNER JOIN rutas ON rutas.id = colocadoras.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = colocadoras.poblacion_id
        /*INNER JOIN garantias ON $this->table.id = garantias.cliente_id */
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

        $query = "SELECT AUTO_INCREMENT
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'proyecto_cobranza'
        AND   TABLE_NAME   = '$table'";

        $result = $this->SelectOne($query);

        return $result['AUTO_INCREMENT'];
               
    }

    public function avalCliente($id)
    {

        $query  = "SELECT avales.* FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
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


    /*public function create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $c_domicilio_cliente, $c_ine_cliente, $c_tarjeton_cliente, 
        $c_contrato_cliente, $c_pagare_cliente, $nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $c_domicilio_aval, $c_ine_aval){


        try{


            $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, comprobante_domicilio, comprobante_ine) VALUES (?, ?, ?, ?, ?, ?)";
            $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $c_domicilio_aval, $c_ine_aval]);

            if($aval) {

                $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias, aval_id, comprobante_domicilio, comprobante_ine,
                comprobante_tarjeton, comprobante_contrato, comprobante_pagare) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $this->lastId(), $c_domicilio_cliente, $c_ine_cliente, $c_tarjeton_cliente,
                $c_contrato_cliente, $c_pagare_cliente]);

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


    public function create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $archivos_cliente, $nombre_aval, 
    $direccion_aval, $telefono_aval, $or_aval, $archivos_aval, $colocadora_id, $garantias_cliente, $garantias_aval){


        try{


            $insertAval = "INSERT INTO avales (nombre_completo, direccion, telefono, otras_referencias, comprobantes, garantias) VALUES (?, ?, ?, ?, ?, ?)";
            $aval = $this->ExecuteQuery($insertAval, [$nombre_aval, $direccion_aval, $telefono_aval, $or_aval, $archivos_aval, $garantias_aval]);

            if($aval) {

                $insertCliente = "INSERT INTO $this->table (nombre_completo, direccion, telefono, otras_referencias, aval_id, comprobantes, colocadora_id, garantias) 
                VALUES (?, ?, ?, ?, ?, ?, ?,?)";
                $cliente = $this->ExecuteQuery($insertCliente, [$nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $this->lastId(), $archivos_cliente, $colocadora_id, $garantias_cliente]);

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

}