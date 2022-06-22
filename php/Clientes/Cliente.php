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
        GROUP_CONCAT(DISTINCT garantias.nombre_garantia SEPARATOR ', ') as 'garantias_cliente',
        GROUP_CONCAT(DISTINCT comprobantes.nombre_comprobante SEPARATOR ', ') as 'comprobantes_cliente'
        FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
        INNER JOIN comprobantes ON $this->table.id = comprobantes.cliente_id 
        INNER JOIN garantias ON $this->table.id = garantias.cliente_id 
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

    public function comprobantesCliente($id){

        $query  = "SELECT comprobantes.nombre_comprobante, comprobantes.url_imagen 
        FROM $this->table 
        INNER JOIN comprobantes ON $this->table.id = comprobantes.cliente_id
        WHERE comprobantes.cliente_id = '$id'
        ORDER BY comprobantes.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function comprobantesAval($id){

        $query  = "SELECT comprobantes.nombre_comprobante, comprobantes.url_imagen 
        FROM avales
        INNER JOIN comprobantes ON avales.id = comprobantes.aval_id
        ORDER BY comprobantes.id DESC";

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


    public function create(){
        
    }

}