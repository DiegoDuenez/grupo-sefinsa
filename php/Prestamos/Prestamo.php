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
        avales.telefono as 'telefono_aval'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function create($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad){

        try{

        
            $insert= "INSERT INTO $this->table (cliente_id, direccion_cliente, telefono_cliente, ruta_id, poblacion_id, colocadora_id, aval_id, monto_prestado, pago_semanal, fecha_prestamo, modalidad_semanas)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $prestamo = $this->ExecuteQuery($insert, [$cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad]);

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