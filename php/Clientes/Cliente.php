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

        
        $query  = "SELECT $this->table.*, avales.id as 'aval_id', avales.nombre_completo as 'nombre_aval'
        FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
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


    public function create($nombre_cliente, $direccion_cliente, $telefono_cliente, $or_cliente, $c_domicilio_cliente, $c_ine_cliente, $c_tarjeton_cliente, 
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


    }

}