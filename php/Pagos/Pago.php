<?php

include '../database.php';
include '../response.php';

class Pago extends Database{

    private $table = 'pagos';

    public function index()
    {

        $query = "SELECT $this->table.*, prestamos.monto_prestado, clientes.nombre_completo
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        ORDER BY $this->table.id DESC
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }
}