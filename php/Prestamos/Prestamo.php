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
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion,
        configuracion_semanas.cantidad as 'semanas',
        clientes.id as 'cliente_id'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
        ORDER BY $this->table.id desc
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);
    }

    public function getPrestamo($prestamo_id){
      
        $query = "SELECT prestamos.*, clientes.nombre_completo, 
        clientes.direccion,
        clientes.telefono, clientes.garantias , 
        avales.nombre_completo as 'nombre_aval', 
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval',
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion,
        configuracion_semanas.cantidad as 'semanas_cantidad',
        configuracion_abonos.tipo_cantidad as 'tipo_abono',
        configuracion_abonos.cantidad as 'cantidad_abono',
        configuracion_abonos.de as 'de',
        configuracion_abonos.por_cada as 'por_cada',
        sum(cantidad_esperada_pago) as debe
        FROM prestamos
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN pagos ON prestamos.id = pagos.prestamo_id
        INNER JOIN configuracion_semanas ON configuracion_semanas.id = prestamos.modalidad_semanas
        INNER JOIN configuracion_abonos ON configuracion_abonos.id = configuracion_semanas.tipo_abono
		WHERE prestamo_id = '$prestamo_id' and pagos.status = 0
        ORDER BY prestamos.id desc;";

        return json([
            'status' => 'success', 
            'data'=> $this->SelectOne($query), 
            'message'=> ''
        ], 200);

    }

    public function renovarPrestamo($prestamo_id, $tarjeton, $monto_renovar, $pago_semanal, $fecha_prestamo, $monto_debe, $modalidad_semanas){


        $monto_prestado = $monto_renovar - $monto_debe;

        $queryPrestamo = "SELECT * FROM $this->table WHERE id = '$prestamo_id'";
        $prestamo = $this->SelectOne($queryPrestamo);

        $this->create($prestamo['cliente_id'], $prestamo['direccion_cliente'], $prestamo['telefono_cliente'], $prestamo['ruta_id'], $prestamo['poblacion_id'],
        $prestamo['colocadora_id'], $prestamo['aval_id'], $monto_renovar, $pago_semanal, $fecha_prestamo, $modalidad_semanas, 0, $tarjeton);

        $queryUpdatePrestamo = "UPDATE $this->table SET $this->table.status = ? WHERE $this->table.id = '$prestamo_id'";
        $update = $this->ExecuteQuery($queryUpdatePrestamo, [2]);

        $queryUpdatePagos = "UPDATE pagos SET cantidad_normal_pagada = cantidad_esperada_pago, cantidad_total_pagada = cantidad_normal_pagada, balance = ?, status = ? WHERE prestamo_id = '$prestamo_id' and status = 0";
        $this->ExecuteQuery($queryUpdatePagos , [0,1]);

        return json([
            'status' => 'success', 
            'data'=> null, 
            'message'=> 'Se ha renovado el prestamo '
        ], 200);


    }

    public function prestamosRuta($ruta_id)
    {

        $query = "SELECT $this->table.*, clientes.nombre_completo, 
        clientes.direccion,
        clientes.telefono, clientes.garantias , 
        avales.nombre_completo as 'nombre_aval', 
        avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval',
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion,
        configuracion_semanas.cantidad as 'semanas'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
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
        avales.telefono as 'telefono_aval',
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion,
        configuracion_semanas.cantidad as 'semanas'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
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
        avales.telefono as 'telefono_aval',
        rutas.nombre_ruta,
        poblaciones.nombre_poblacion,
        configuracion_semanas.cantidad as 'semanas'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
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
        avales.telefono as 'telefono_aval',
        configuracion_semanas.cantidad as 'semanas'
        FROM $this->table
        INNER JOIN clientes ON $this->table.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id
        INNER JOIN rutas ON prestamos.ruta_id = rutas.id
        INNER JOIN colocadoras ON prestamos.colocadora_id = colocadoras.id
        INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
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

            if(!$this->existsData('prestamos', 'numero_tarjeton', trim($tarjeton))){

            

                $insert= "INSERT INTO $this->table (cliente_id, direccion_cliente, telefono_cliente, ruta_id, poblacion_id, colocadora_id, aval_id, monto_prestado, monto_prestado_intereses, pago_semanal, fecha_prestamo, modalidad_semanas, numero_tarjeton)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $prestamo = $this->ExecuteQuery($insert, [$cliente_id, $direccion_cliente, $telefono_cliente, $ruta_id, $poblacion_id, $colocadora_id, $aval_id, $monto_prestado, $monto_prestado_intereses, $pago_semanal, $fecha_prestamo, $modalidad, $tarjeton]);

                $prestamo_id = $this->lastId();

                $queryModalidad = "SELECT * FROM configuracion_semanas WHERE id = '$modalidad'";
                $modalidad = $this->SelectOne($queryModalidad);


                if($prestamo){
                    /*$queryBalance = "SELECT sum(cantidad_esperada_pago) as debe from pagos WHERE prestamo_id = '$prestamo_id'";
                    $balance = $this->SelectOne($queryBalance);*/
                    
                    // ARREGLAR ESTO
                    $balance = $pago_semanal * $modalidad['cantidad'];
                    for($i = 1; $i <= $modalidad['cantidad']; $i++)
                    {
                        $fecha = date("Y-m-d",strtotime($fecha_prestamo."+ $i week"));           
                        //array_push($arreglo_fechas, $fecha);
                        $insert= "INSERT INTO pagos (prestamo_id, cantidad_esperada_pago, cantidad_normal_pagada, cantidad_multa, cantidad_total_pagada, fecha_pago, semana, balance)
                        VALUES (?, ?, ?, ?, ?, ?, ?,?)";
                        $pago = $this->ExecuteQuery($insert, [$prestamo_id, $pago_semanal, 0, 0, 0, $fecha, $i, $balance]);
                        if($i == $modalidad['cantidad']){
                           return true;
                        }
                    }

                    //$this->generarPagos($this->lastId(), $fecha_prestamo, $modalidad, $monto_prestado, 0, 0, $monto_prestado);

                }
                else {

                   /* return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al registrar el prestamo'
                    ], 400);*/

                    return false;

                }

            }
            else{
                return  false;
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