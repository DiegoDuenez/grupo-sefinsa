<?php

include '../database.php';
include '../response.php';

class Pago extends Database{

    private $table = 'pagos';

    public function index()
    {

        $query = "SELECT $this->table.*,prestamos.monto_prestado, clientes.nombre_completo, poblaciones.monto_multa
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        ORDER BY clientes.nombre_completo ASC
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }

    public function pagosCliente($cliente_id)
    {

        $query = "SELECT $this->table.*,prestamos.monto_prestado, clientes.nombre_completo, poblaciones.monto_multa
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        WHERE clientes.id = '$cliente_id'
        ORDER BY clientes.nombre_completo ASC
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }


    public function pagar($pago_id, $prestamo_id, $pago_recibido, $pago_multa, $concepto)
    {
        try{

            $status = 1;
            $pago_total = $pago_recibido + $pago_multa;

            $query = "SELECT * FROM $this->table WHERE id = '$pago_id'";
            $queryPago = $this->SelectOne($query);

            /*if($queryPago['cantidad_esperada_pago'] == $pago_recibido && $pago_multa = 0){
                $status = 1; 
            }*/

            $update = "UPDATE $this->table SET cantidad_normal_pagada = ?, cantidad_multa = ?, cantidad_total_pagada = ?, concepto = ?, status = ? WHERE $this->table.id = '$pago_id'";
            $pago = $this->ExecuteQuery($update, [$pago_recibido, $pago_multa, $pago_total, $concepto , $status]);

            //$update = "UPDATE $this->table SET cantidad_normal_pagada = ?, cantidad_multa = ?, cantidad_total_pagada = ?, concepto = '$concepto', status = ? WHERE $this->table.id = '$pago_id'";
            //$pago = $this->ExecuteQuery($update, [$pago_recibido, $pago_multa, $pago_total, $status]);
            //echo $update;

            if($pago) {

              
                $query = "SELECT sum(cantidad_normal_pagada) as 'sumatoria' FROM $this->table WHERE prestamo_id = '$prestamo_id'";
                $sumatoria = $this->SelectOne($query);

                $queryPrestamo = "SELECT monto_prestado FROM prestamos WHERE id = '$prestamo_id'";
                $prestamo = $this->SelectOne($queryPrestamo);

                $queryPago = "SELECT cantidad_esperada_pago FROM $this->table WHERE id = '$pago_id'";
                $pago = $this->SelectOne($queryPago);

                if($pago_recibido < $pago['cantidad_esperada_pago']){
                    $diferencia = $pago['cantidad_esperada_pago'] - $pago_recibido;

                    $queryNextRow = "SELECT * FROM $this->table WHERE id > $pago_id ORDER BY id LIMIT 1";
                    $siguientePago = $this->SelectOne($queryNextRow);

                    $update = "UPDATE $this->table SET cantidad_esperada_pago = cantidad_esperada_pago + '$diferencia' WHERE $this->table.id = '".$siguientePago['id']."'";
                    $updateSiguientePago = $this->ExecuteQuery($update, []);
                }


                if($sumatoria['sumatoria'] >= $prestamo['monto_prestado']){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha hecho el pago correctamente y se finalizo el prestamo'
                    ], 200);
                }
                

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha hecho el pago correctamente'
                ], 200);

            } 


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }
    }


}