<?php

include '../database.php';
include '../response.php';

class Pago extends Database{

    private $table = 'pagos';

    public function index()
    {

        $query = "SELECT $this->table.*,prestamos.monto_prestado, clientes.nombre_completo, poblaciones.monto_multa,
        poblaciones.nombre_poblacion, rutas.nombre_ruta, prestamos.fecha_prestamo, prestamos.modalidad_semanas
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        INNER JOIN rutas ON clientes.ruta_id = rutas.id
        ORDER BY $this->table.prestamo_id DESC, $this->table.fecha_pago ASC
        ";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }

    public function pagosPrestamoPagados($prestamo_id){

        $query = "SELECT $this->table.* from $this->table
        INNER JOIN prestamos ON prestamos.id = pagos.prestamo_id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        where prestamos.id = '$prestamo_id' and $this->table.status != 0
        ORDER BY $this->table.semana DESC";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }

    

    public function omitirSemanaPago($pago_id){

        try{

            $update = "UPDATE $this->table SET status = ? WHERE $this->table.id = '$pago_id'";
            $omitido = $this->ExecuteQuery($update, [2]);

            $query = "SELECT prestamo_id FROM $this->table WHERE $this->table.id = '$pago_id'";
            $pago = $this->SelectOne($query);

            if($omitido) {

                $update = "UPDATE prestamos set status = ? WHERE prestamos.id = '". $pago['prestamo_id'] ."'";
                $this->ExecuteQuery($update, [1]);

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha omitido la semana de pago y finalizado el prestamo'
                ], 200);

            } 
            else{
                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha omitido la semana de pago y finalizado el prestamo'
                ], 200);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function pagosPrestamo($prestamo_id)
    {

        $query = "SELECT $this->table.*,prestamos.monto_prestado, clientes.nombre_completo, poblaciones.monto_multa,
        poblaciones.nombre_poblacion, rutas.nombre_ruta, prestamos.fecha_prestamo, prestamos.modalidad_semanas
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        INNER JOIN rutas ON clientes.ruta_id = rutas.id
        WHERE prestamos.id = '$prestamo_id'
        ORDER BY $this->table.prestamo_id DESC, $this->table.fecha_pago ASC";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }

    public function pagosCliente($cliente_id)
    {

        $query = "SELECT $this->table.*,prestamos.monto_prestado, clientes.nombre_completo, poblaciones.monto_multa,
        poblaciones.nombre_poblacion, rutas.nombre_ruta, prestamos.fecha_prestamo, prestamos.modalidad_semanas
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        INNER JOIN rutas ON clientes.ruta_id = rutas.id
        WHERE clientes.id = '$cliente_id'
        ORDER BY $this->table.prestamo_id DESC, $this->table.fecha_pago ASC";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ''
        ], 200);

    }

    public function puedeOmitirUltimaSemana($prestamo_id){

        try{

            //PENDIENTE CHECAR SI TIENE MULTAS
            $queryCantidadMultas = "SELECT count(id) as cantidad_multas FROM $this->table WHERE prestamo_id = '$prestamo_id' and cantidad_multa != 0;";
            $cantidadMultas = $this->SelectOne($queryCantidadMultas);

            //PENDIENTE CHECAR EN QUE SEMANA VA
            $queryCantidadSemanas = "SELECT count(id) as cantidad_semanas FROM $this->table WHERE prestamo_id = '$prestamo_id' and pagos.status = 1 or prestamo_id = '$prestamo_id' and pagos.status = -1";
            $cantidadSemanas = $this->SelectOne($queryCantidadSemanas);

            if($cantidadMultas['cantidad_multas'] == 0 && $cantidadSemanas['cantidad_semanas']  == 14){

                return json([
                    'status' => 'success', 
                    'data'=> true, 
                    'message'=> 'Se puede omitir la semana 15 de este prestamo'
                ], 200);
                
            } 
            else if($cantidadMultas['cantidad_multas'] == 0 && $cantidadSemanas['cantidad_semanas']  == 19){

                return json([
                    'status' => 'success', 
                    'data'=> true, 
                    'message'=> 'Se puede omitir la semana 19 de este prestamo'
                ], 200);

            }
            else{
                return json([
                    'status' => 'success', 
                    'data'=> false, 
                    'message'=> 'No disponible'
                ], 200);
            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }
        
    }


    public function pagar($pago_id, $prestamo_id, $pago_recibido, $pago_multa, $concepto, $fecha_pago, $folio)
    {
        try{

            if(!$this->existsData('pagos', 'folio', trim($folio))){

                $status = 1;
                $pago_total = $pago_recibido + $pago_multa;

                $query = "SELECT * FROM $this->table WHERE id = '$pago_id'";
                $queryPago = $this->SelectOne($query);

                $queryPrestamo = "SELECT monto_prestado FROM prestamos WHERE id = '$prestamo_id'";
                $prestamo = $this->SelectOne($queryPrestamo);

                $update = "UPDATE $this->table SET cantidad_normal_pagada = ?, cantidad_multa = ?, cantidad_total_pagada = ?, 
                concepto = ?, status = ?, fecha_pago_realizada = ?, folio = ? WHERE $this->table.id = '$pago_id'";
                $pago = $this->ExecuteQuery($update, [$pago_recibido, $pago_multa, $pago_total, $concepto , $status, $fecha_pago, $folio]);



                if($pago) {

                    
                    $query = "SELECT sum(cantidad_normal_pagada) as 'sumatoria' FROM $this->table WHERE prestamo_id = '$prestamo_id'";
                    $sumatoria = $this->SelectOne($query);

                    $queryPrestamo = "SELECT monto_prestado, pago_semanal FROM prestamos WHERE id = '$prestamo_id'";
                    $prestamo = $this->SelectOne($queryPrestamo);

                    $queryPago = "SELECT cantidad_esperada_pago FROM $this->table WHERE id = '$pago_id'";
                    $pago = $this->SelectOne($queryPago);

                    $queryBalance = "select * from pagos WHERE prestamo_id = '$prestamo_id' and status = 0; ";
                    $balance = $this->SelectOne($queryBalance);

                    $calculoBalance = $balance['balance'] - $pago_recibido;

                    $pagoCantidadSemanas = "SELECT configuracion_semanas.cantidad as cantidad_semanas from pagos INNER JOIN prestamos ON pagos.prestamo_id = prestamos.id
                    INNER JOIN configuracion_semanas ON prestamos.modalidad_semanas = configuracion_semanas.id
                    WHERE pagos.prestamo_id = '$prestamo_id' limit 1";
                    $pagoCantidadSemanas =  $this->SelectOne($pagoCantidadSemanas);

                    

                    if($pago_recibido < $pago['cantidad_esperada_pago']){

                        $diferencia = $pago['cantidad_esperada_pago'] - $pago_recibido;

                        $queryNextRow = "SELECT * FROM $this->table WHERE id > $pago_id ORDER BY id LIMIT 1";
                        $siguientePago = $this->SelectOne($queryNextRow);

                        $update = "UPDATE $this->table SET cantidad_pendiente = ? WHERE $this->table.id = '$pago_id'";
                        $pago = $this->ExecuteQuery($update, [$diferencia]);

                        $update = "UPDATE $this->table SET cantidad_esperada_pago = cantidad_esperada_pago + '$diferencia' WHERE $this->table.id = '".$siguientePago['id']."'";
                        $updateSiguientePago = $this->ExecuteQuery($update, []);

                    }
                    else if($pago_recibido > $pago['cantidad_esperada_pago']){}

                    //PENDIENTE CHECAR SI TIENE MULTAS
                    $queryCantidadMultas = "SELECT count(id) as cantidad_multas FROM $this->table WHERE prestamo_id = '$prestamo_id' and cantidad_multa != 0;";
                    $cantidadMultas = $this->SelectOne($queryCantidadMultas);

                    //PENDIENTE CHECAR EN QUE SEMANA VA
                    $queryCantidadSemanas = "SELECT count(id) as cantidad_semanas FROM $this->table WHERE prestamo_id = '$prestamo_id' and pagos.status = 1 or prestamo_id = '$prestamo_id' and pagos.status = -1";
                    $cantidadSemanas = $this->SelectOne($queryCantidadSemanas);

                    if($cantidadSemanas['cantidad_semanas']  == $pagoCantidadSemanas['cantidad_semanas']){

                        $update = "UPDATE prestamos set status = ? WHERE prestamos.id = '$prestamo_id'";
                        $this->ExecuteQuery($update, [1]);

                        return json([
                            'status' => 'success', 
                            'data'=> true, 
                            'message'=> 'Se ha hecho el pago correctamente y finalizado prestamo de 15 semanas'
                        ], 200);
                        
                    } 
             
                    if($pago_recibido == $balance['balance']){

                        $queryUpdatePagos = "UPDATE $this->table SET cantidad_esperada_pago = 0, cantidad_normal_pagada = 0, cantidad_total_pagada = 0, status = ? WHERE prestamo_id = '$prestamo_id' and id > '$pago_id' and status = 0";
                        $this->ExecuteQuery($queryUpdatePagos , [1]);

                        $queryUpdatePrestamo = "UPDATE prestamos  SET prestamos.status = ? WHERE prestamos.id = '$prestamo_id'";
                        $update = $this->ExecuteQuery($queryUpdatePrestamo, [1]);

                    }


                    $update = "UPDATE $this->table SET balance = ? WHERE prestamo_id = '$prestamo_id'";
                    $pago2 = $this->ExecuteQuery($update, [$calculoBalance]);

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha hecho el pago correctamente'
                    ], 200);

                } 
            }
            else{
                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El folio ya fue registrado en otro pago'
                ], 400);
            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }
    }


    public function noPagar($pago_id, $pago_multa, $semana){

        try{

            $fecha_no_pago = date('Y-m-d');

            $query = "SELECT * FROM $this->table WHERE id = '$pago_id'";
            $queryPago = $this->SelectOne($query);

            $prestamo_id = $queryPago['prestamo_id'];

            if($semana != 15 && $semana != 20){

                $queryNextRow = "SELECT * FROM $this->table WHERE id > $pago_id ORDER BY id LIMIT 1";
                $siguientePago = $this->SelectOne($queryNextRow);
                $siguientePagoId = $siguientePago['id'];

                $pago_siguiente = $siguientePago['cantidad_esperada_pago'] + $queryPago['cantidad_esperada_pago'];

                $queryPrestamo = "SELECT monto_prestado FROM prestamos WHERE id = '$prestamo_id'";
                $prestamo = $this->SelectOne($queryPrestamo);


                $update = "UPDATE $this->table SET fecha_pago_realizada = ?, status = ? WHERE $this->table.id = '$pago_id'";
                $pago1 = $this->ExecuteQuery($update, [$fecha_no_pago, -1]);

                $update = "UPDATE $this->table SET cantidad_esperada_pago = ? WHERE $this->table.id = '$siguientePagoId'";
                $pago2 = $this->ExecuteQuery($update, [$pago_siguiente]);

                 
                if($pago1 && $pago2) {

                    $queryPago = "SELECT cantidad_esperada_pago FROM $this->table WHERE id = '$pago_id'";
                    $pago = $this->SelectOne($queryPago);

                    $update = "UPDATE $this->table SET cantidad_pendiente = ? WHERE $this->table.id = '$pago_id'";
                    $pago = $this->ExecuteQuery($update, [$pago['cantidad_esperada_pago']]);
                

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha hecho el no pago correctamente'
                    ], 200);

                } 

            }
            else if($semana == 15 || $semana == 20){

                $queryPago = "SELECT cantidad_esperada_pago FROM $this->table WHERE id = '$pago_id'";
                $pago = $this->SelectOne($queryPago);

                $update = "UPDATE $this->table SET cantidad_pendiente = ?, fecha_pago_realizada = ?, status = ? WHERE $this->table.id = '$pago_id'";
                $pago = $this->ExecuteQuery($update, [$pago['cantidad_esperada_pago'], $fecha_no_pago, -1]);

                $update = "UPDATE prestamos SET prestamos.status = ? WHERE prestamos.id = '$prestamo_id'";
                $this->ExecuteQuery($update, [-1]);

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha hecho el no pago correctamente'
                ], 200);
            }



        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function fechasPagos($prestamo_id){


        $queryFechas  = "SELECT group_concat(pagos.fecha_pago  SEPARATOR ', ') as fechas_pago FROM pagos WHERE prestamo_id = '$prestamo_id'";
        $fechas = $this->SelectOne($queryFechas);

        $str_arr = explode (",", $fechas['fechas_pago']);
        $cases = [];
        $casesWhen = "";

        for($j = 0; $j < count($str_arr); $j++){
            $semana = $j + 1;
            if($j == count($str_arr) - 1){
                $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$j]' THEN fecha_pago END) semana$semana ";
            }
            else{
                $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$j]' THEN fecha_pago END) semana$semana, ";
            }
        }

        $query = "SELECT prestamos.*, clientes.nombre_completo, clientes.direccion,clientes.telefono, clientes.garantias , avales.nombre_completo as 'nombre_aval', avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', prestamos.monto_prestado, prestamos.pago_semanal, pagos.prestamo_id, prestamos.modalidad_semanas ,prestamos.status, $casesWhen FROM pagos
        INNER JOIN prestamos on pagos.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id 
        WHERE prestamos.id = '$prestamo_id'
        GROUP BY pagos.prestamo_id
        ";
        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> ""
        ], 200);

    }


}