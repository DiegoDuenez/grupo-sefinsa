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

    public function prestamosRuta($ruta_id)
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
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        WHERE prestamos.ruta_id = '$ruta_id'
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function prestamosPoblacion($poblacion_id)
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
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        WHERE prestamos.poblacion_id = '$poblacion_id'
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function prestamosColocadora($colocadora_id)
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
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        WHERE prestamos.colocadora_id = '$colocadora_id'
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function prestamosCliente($cliente_id)
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
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        WHERE prestamos.cliente_id = '$cliente_id'
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function create($cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $pago_semanal, $fecha_prestamo, $modalidad, $monto_prestado_intereses, $tarjeton){

        try{

        
            $insert= "INSERT INTO $this->table (cliente_id, direccion_cliente, telefono_cliente, ruta_id, poblacion_id, colocadora_id, aval_id, monto_prestado, monto_prestado_intereses, pago_semanal, fecha_prestamo, modalidad_semanas, numero_tarjeton)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $prestamo = $this->ExecuteQuery($insert, [$cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $monto_prestado_intereses, $pago_semanal, $fecha_prestamo, $modalidad, $tarjeton]);

            $prestamo_id = $this->lastId();


            if($prestamo){

                $insertado = false;

                
                for($i = 1; $i <= $modalidad; $i++)
                {
                    $fecha = date("Y-m-d",strtotime($fecha_prestamo."+ $i week"));           
                    //array_push($arreglo_fechas, $fecha);
                    $insert= "INSERT INTO pagos (prestamo_id, cantidad_esperada_pago, cantidad_normal_pagada, cantidad_multa, cantidad_total_pagada, fecha_pago)
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $pago = $this->ExecuteQuery($insert, [$prestamo_id, $pago_semanal, 0, 0, 0, $fecha]);
                    if($i ==  15){
                        $insertado = true;
                    }
                }

                if($insertado){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha registrado el prestamo'
                    ], 200);
                }
                else{
                    echo $pago;
                }
                //$this->generarPagos($this->lastId(), $fecha_prestamo, $modalidad, $monto_prestado, 0, 0, $monto_prestado);

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

    public function generarPagos($prestamo_id, $fecha_actual, $cantidad_semanas, $cantidad_esperada, $cantidad_pagada, $cantidad_multa, $cantidad_total){

        try{

            $arreglo_fechas = [];
            $insertado = true;

            for($i = 1; $i <= $cantidad_semanas; $i++)
            {
                $fecha = date("Y-m-d",strtotime($fecha_actual."+ $i week"));           
                //array_push($arreglo_fechas, $fecha);
                $insert= "INSERT INTO pagos (prestamo_id, cantidad_esperada_pago, cantidad_normal_pagada, cantidad_multa, cantidad_total_pagada, fecha_pago)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
                $prestamo = $this->ExecuteQuery($insert, [$prestamo_id, $cantidad_esperada, $cantidad_pagada, $cantidad_multa, $cantidad_total, $fecha]);
                //$i == 15 ? $insertado = true : $insertado = false;
            }

//            echo implode(", ", $arreglo_fechas);       
        
            /*$insert= "INSERT INTO pagos (prestamo_id, cantidad_esperada_pago, cantidad_normal_pagada, cantidad_multa, cantidad_total_pagada, fecha_pago)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $prestamo = $this->ExecuteQuery($insert, [$prestamo_id, $cantidad_esperada, $cantidad_pagada, $cantidad_multa, $cantidad_total, $fecha]);
*/

            if($insertado){

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