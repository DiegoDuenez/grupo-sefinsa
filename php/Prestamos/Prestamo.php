<?php


class Prestamo extends Database{

    private $table = 'prestamos';

    public function index()
    {

        $query = "SELECT $this->table.*, clientes.nombre_completo, 
        clientes.direccion,
        clientes.telefono, clientes.garantias , 
        avales.nombre_completo as 'nombre_aval', 
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval',
        poblaciones.semanas_pago
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON clientes.aval_id = avales.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function create($cliente_id, $monto_prestado, $pago_semanal, $fecha_prestamo){

        try{

        
            $insert= "INSERT INTO $this->table (cliente_id, monto_prestado, pago_semanal, fecha_prestamo) VALUES (?, ?, ?, ?)";
            $prestamo = $this->ExecuteQuery($insert, [$cliente_id, $monto_prestado, $pago_semanal, $fecha_prestamo]);

            if($prestamo){

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha registrado el prestamo'
                ], 200);

            }
            else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al registrar el prestamo'
                ], 400);

            }

          

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }


}