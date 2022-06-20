<?php

include '../database.php';
include '../response.php';

class Cliente extends Database{

    private $table = 'clientes';

    public function index()
    {

        $query  = "SELECT $this->table.* FROM $this->table 
        INNER JOIN avales ON $this->table.aval_id = avales.id
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
}