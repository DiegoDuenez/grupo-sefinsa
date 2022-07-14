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
        ORDER BY $this->table.prestamo_id DESC, $this->table.fecha_pago ASC
        ";

        $queryPrestamos = "SELECT prestamo_id FROM pagos GROUP BY prestamo_id";
        $prestamos_id = $this->Select($queryPrestamos);

        /*$puedeOmitirUltimaSemana = false;

        $keys = array_keys($prestamos_id);
        $arraySize = count($prestamos_id); 

        for($i=0; $i < $arraySize; $i++) {
            $id = $prestamos_id[$i]['prestamo_id'];

            //PENDIENTE CHECAR SI TIENE MULTAS
            $queryCantidadMultas = "SELECT count(id) as cantidad_multas FROM $this->table WHERE prestamo_id = '$id' and cantidad_multa != 0;";
            $cantidadMultas = $this->SelectOne($queryCantidadMultas);

            //PENDIENTE CHECAR EN QUE SEMANA VA
            $queryCantidadSemanas = "SELECT count(id) as cantidad_semanas FROM pagos WHERE prestamo_id = '$id' and pagos.status = 1 || pagos.status = -1";
            $cantidadSemanas = $this->SelectOne($queryCantidadSemanas);

            if($cantidadMultas['cantidad_multas'] == 0 && $cantidadSemanas['cantidad_semanas']  == 14){

                $puedeOmitirUltimaSemana = true;
                
            } 
            else if($cantidadMultas['cantidad_multas'] == 0 && $cantidadSemanas['cantidad_semanas']  == 19){

                $puedeOmitirUltimaSemana = true;

            }
            else{
                $puedeOmitirUltimaSemana = false;

            }
        }*/

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

        $query = "SELECT $this->table.*,prestamos.monto_prestado, 
        clientes.nombre_completo, poblaciones.monto_multa
        FROM $this->table 
        INNER JOIN prestamos ON $this->table.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN poblaciones ON clientes.poblacion_id = poblaciones.id
        WHERE prestamos.id = '$prestamo_id'
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
        ORDER BY $this->table.prestamo_id DESC, $this->table.fecha_pago ASC
        ";

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


    public function pagar($pago_id, $prestamo_id, $pago_recibido, $pago_multa, $concepto)
    {
        try{

            $status = 1;
            $pago_total = $pago_recibido + $pago_multa;

            $query = "SELECT * FROM $this->table WHERE id = '$pago_id'";
            $queryPago = $this->SelectOne($query);

        

            $update = "UPDATE $this->table SET cantidad_normal_pagada = ?, cantidad_multa = ?, cantidad_total_pagada = ?, concepto = ?, status = ? WHERE $this->table.id = '$pago_id'";
            $pago = $this->ExecuteQuery($update, [$pago_recibido, $pago_multa, $pago_total, $concepto , $status]);

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

                    $update = "UPDATE $this->table SET cantidad_pendiente = ? WHERE $this->table.id = '$pago_id'";
                    $pago = $this->ExecuteQuery($update, [$diferencia]);

                    $update = "UPDATE $this->table SET cantidad_esperada_pago = cantidad_esperada_pago + '$diferencia' WHERE $this->table.id = '".$siguientePago['id']."'";
                    $updateSiguientePago = $this->ExecuteQuery($update, []);
                }


                /*if($sumatoria['sumatoria'] >= $prestamo['monto_prestado']){
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha hecho el pago correctamente y se finalizo el prestamo'
                    ], 200);
                }*/

                //PENDIENTE CHECAR SI TIENE MULTAS
                $queryCantidadMultas = "SELECT count(id) as cantidad_multas FROM $this->table WHERE prestamo_id = '$prestamo_id' and cantidad_multa != 0;";
                $cantidadMultas = $this->SelectOne($queryCantidadMultas);

                //PENDIENTE CHECAR EN QUE SEMANA VA
                $queryCantidadSemanas = "SELECT count(id) as cantidad_semanas FROM $this->table WHERE prestamo_id = '$prestamo_id' and pagos.status = 1 or prestamo_id = '$prestamo_id' and pagos.status = -1";
                $cantidadSemanas = $this->SelectOne($queryCantidadSemanas);

                if($cantidadSemanas['cantidad_semanas']  == 15){

                    $update = "UPDATE prestamos set status = ? WHERE prestamos.id = '$prestamo_id'";
                    $this->ExecuteQuery($update, [1]);

                    return json([
                        'status' => 'success', 
                        'data'=> true, 
                        'message'=> 'Se ha hecho el pago correctamente y finalizado prestamo de 15 semanas'
                    ], 200);
                    
                } 
                else if($cantidadSemanas['cantidad_semanas']  == 20){

                    $update = "UPDATE prestamos set status = ? WHERE prestamos.id = '$prestamo_id'";
                    $this->ExecuteQuery($update, [1]);

                    return json([
                        'status' => 'success', 
                        'data'=> true, 
                        'message'=> 'Se ha hecho el pago correctamente y finalizado prestamo de 20 semanas'
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


    public function noPagar($pago_id, $pago_multa){

        try{

            $query = "SELECT * FROM $this->table WHERE id = '$pago_id'";
            $queryPago = $this->SelectOne($query);

            $queryNextRow = "SELECT * FROM $this->table WHERE id > $pago_id ORDER BY id LIMIT 1";
            $siguientePago = $this->SelectOne($queryNextRow);
            $siguientePagoId = $siguientePago['id'];

            $pago_siguiente = $siguientePago['cantidad_esperada_pago'] + $queryPago['cantidad_esperada_pago'];


            $update = "UPDATE $this->table SET status = ? WHERE $this->table.id = '$pago_id'";
            $pago1 = $this->ExecuteQuery($update, [-1]);

            $update = "UPDATE $this->table SET cantidad_esperada_pago = ? WHERE $this->table.id = '$siguientePagoId'";
            $pago2 = $this->ExecuteQuery($update, [$pago_siguiente]);


            if($pago1 && $pago2) {

              
                /*$query = "SELECT sum(cantidad_normal_pagada) as 'sumatoria' FROM $this->table WHERE prestamo_id = '$prestamo_id'";
                $sumatoria = $this->SelectOne($query);

                $queryPrestamo = "SELECT monto_prestado FROM prestamos WHERE id = '$prestamo_id'";
                $prestamo = $this->SelectOne($queryPrestamo);

                $queryPago = "SELECT cantidad_esperada_pago FROM $this->table WHERE id = '$pago_id'";
                $pago = $this->SelectOne($queryPago);

                if($pago_recibido < $pago['cantidad_esperada_pago']){

                    $diferencia = $pago['cantidad_esperada_pago'] - $pago_recibido;

                    $queryNextRow = "SELECT * FROM $this->table WHERE id > $pago_id ORDER BY id LIMIT 1";
                    $siguientePago = $this->SelectOne($queryNextRow);

                    $update = "UPDATE $this->table SET cantidad_pendiente = ? WHERE $this->table.id = '$pago_id'";
                    $pago = $this->ExecuteQuery($update, [$diferencia]);

                    $update = "UPDATE $this->table SET cantidad_esperada_pago = cantidad_esperada_pago + '$diferencia' WHERE $this->table.id = '".$siguientePago['id']."'";
                    $updateSiguientePago = $this->ExecuteQuery($update, []);
                }*/


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

        /*$queryIdPrestamos  = "SELECT group_concat(prestamos.id SEPARATOR ', ') as ids FROM prestamos ";
        $ids = $this->SelectOne($queryIdPrestamos);
        $id_arr= explode (",", $ids['ids']); */

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

        /*for($i = 0; $i < count($id_arr); $i++){

            
            $queryFechas  = "SELECT group_concat(pagos.fecha_pago  SEPARATOR ', ') as fechas_pago FROM pagos WHERE prestamo_id = '$id_arr[$i]'";
            $fechas = $this->SelectOne($queryFechas);

            $str_arr = explode (",", $fechas['fechas_pago']);
            $cases = [];
            $casesWhen = "";

            for($j = 0; $j < count($str_arr); $j++){
                $semana = $j + 1;
                if($j == count($str_arr) - 1){
                    $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$j]' THEN fecha_pago END) semana$semana ";
                    array_push($cases, $casesWhen);
                    //echo $casesWhen;
                    //$cases[] = $casesWhen;
                }
                else{
                    $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$j]' THEN fecha_pago END) semana$semana, ";
                }
            }

        }
        for($x = 0; $x < count($cases); $x){
            $query = "SELECT clientes.nombre_completo, clientes.direccion,clientes.telefono, clientes.garantias , 
                avales.nombre_completo as 'nombre_aval', avales.direccion as 'direccion_aval',
                avales.telefono as 'telefono_aval', prestamos.monto_prestado, prestamos.pago_semanal, pagos.prestamo_id, 
                $cases[$x] FROM pagos
                INNER JOIN prestamos on pagos.prestamo_id = prestamos.id
                INNER JOIN clientes ON prestamos.cliente_id = clientes.id
                INNER JOIN avales ON prestamos.aval_id = avales.id
                INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id GROUP BY pagos.prestamo_id";
                $data = $this->Select($query);
                var_dump($data);

                echo $cases[$x];
        }*/

        
        

            /*for($x = 0; $x < count($cases); $x){
                $query = "SELECT clientes.nombre_completo, clientes.direccion,clientes.telefono, clientes.garantias , 
                    avales.nombre_completo as 'nombre_aval', avales.direccion as 'direccion_aval',
                    avales.telefono as 'telefono_aval', prestamos.monto_prestado, prestamos.pago_semanal, pagos.prestamo_id, 
                    $cases[$x] FROM pagos
                    INNER JOIN prestamos on pagos.prestamo_id = prestamos.id
                    INNER JOIN clientes ON prestamos.cliente_id = clientes.id
                    INNER JOIN avales ON prestamos.aval_id = avales.id
                    INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id GROUP BY pagos.prestamo_id";
                    $data = $this->Select($query);
                    var_dump($data);
            }*/
        
        

        /*$casesWhen = "";

        for($i = 0; $i < count($str_arr); $i++){
            $semana = $i + 1;
            if($i == count($str_arr) - 1){
            $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$i]' THEN fecha_pago END) semana$semana";
            }
            else{
                $casesWhen .= "MAX(CASE WHEN fecha_pago = '$str_arr[$i]' THEN fecha_pago END) semana$semana,";
            }
        }


        $query = "SELECT clientes.nombre_completo, clientes.direccion,clientes.telefono, clientes.garantias , avales.nombre_completo as 'nombre_aval', avales.direccion as 'direccion_aval',
        avales.telefono as 'telefono_aval', prestamos.monto_prestado, prestamos.pago_semanal, pagos.prestamo_id, $casesWhen FROM pagos
        INNER JOIN prestamos on pagos.prestamo_id = prestamos.id
        INNER JOIN clientes ON prestamos.cliente_id = clientes.id
        INNER JOIN avales ON prestamos.aval_id = avales.id
        INNER JOIN poblaciones ON prestamos.poblacion_id = poblaciones.id GROUP BY pagos.prestamo_id";

        return json([
            'status' => 'success', 
            'data'=> $this->Select($query), 
            'message'=> $query
        ], 200);*/

    }


}