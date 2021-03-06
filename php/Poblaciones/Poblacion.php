<?php

include '../database.php';
include '../response.php';

class Poblacion extends Database{

    private $table = 'poblaciones';

    public function index(){

        $query = "SELECT $this->table.*, rutas.nombre_ruta FROM $this->table
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id ORDER BY $this->table.id DESC";

        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function poblacionesRuta($id)
    {

        $query = "SELECT  $this->table.*, rutas.nombre_ruta FROM $this->table
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id 
        WHERE rutas.id = '$id'
        ORDER BY $this->table.id DESC";

        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre, $ruta_id, $primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo){

        try{

            if(!$this->existsData($this->table, 'nombre_poblacion', trim($nombre))){

                $insert = "INSERT INTO $this->table (nombre_poblacion, ruta_id, primer_hora_limite, segunda_hora_limite, monto_multa, primer_dia_cobro, grupo) VALUES (?, ?, ?, ?, ?,?, ?)";
                $localidad = $this->ExecuteQuery($insert, [$nombre, $ruta_id, $primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo]);

                /*$insert2 = "INSERT INTO ruta_localidades (ruta_id, localidad_id) VALUES (?,?)";
                $localidad_ruta = $this->ExecuteQuery($insert2, [$ruta_id, $this->lastInsertId()]);*/

               if($localidad) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado la poblacion'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear la poblacion'
                    ], 400);

                }


            }
            else{

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El nombre de poblacion ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function edit($nombre, $ruta_id, $id, $primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo){

        try{

            if(!$this->existsData($this->table, 'nombre_poblacion', trim($nombre), $id)){

                $update = "UPDATE $this->table SET nombre_poblacion = ?, ruta_id = ?, primer_hora_limite = ?, segunda_hora_limite = ?, monto_multa = ?,
                primer_dia_cobro = ?, grupo = ? WHERE id = '$id'";
                $localidad = $this->ExecuteQuery($update, [$nombre, $ruta_id, $primer_hora_limite, $segunda_hora_limite, $monto_multa, $dia_cobro, $grupo]);


               if($localidad) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado la localidad'
                    ], 200);

                } else {

                    return json([
                        'status' => 'success', 
                        'data'=>null, 
                        'message'=>'No se actualizo nada nuevo'
                    ], 200);

                }


            }
            else{

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El nombre de localidad ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function localidadesRuta($id){

        $query  = "SELECT  $this->table.*, rutas.nombre_ruta FROM rutas
        INNER JOIN ruta_localidades ON rutas.id = ruta_localidades.ruta_id 
        INNER JOIN localidades ON  $this->table.id = ruta_localidades.localidad_id 
        WHERE rutas.id = '$id'";

        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }



}