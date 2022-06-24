<?php

include '../database.php';
include '../response.php';

class Colocadora extends Database{

    private $table = 'colocadoras';

    public function index()
    {
        $query = "SELECT $this->table.*, rutas.nombre_ruta, poblaciones.nombre_poblacion FROM $this->table
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
    }

    public function colocadorasActivas()
    {
        $query = "SELECT $this->table.*, rutas.nombre_ruta, poblaciones.nombre_poblacion FROM $this->table
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE $this->table.status = 1
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
    }

    public function colocadorasRutaPoblacion($ruta_id, $poblacion_id){

        $query = "SELECT $this->table.*, rutas.nombre_ruta, poblaciones.nombre_poblacion FROM $this->table
        INNER JOIN rutas ON rutas.id = $this->table.ruta_id
        INNER JOIN poblaciones ON poblaciones.id = $this->table.poblacion_id
        WHERE $this->table.ruta_id = '$ruta_id' AND $this->table.poblacion_id = '$poblacion_id'
        and $this->table.status = 1
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre, $direccion, $telefono, $ruta_id, $poblacion_id){

        try{

            $insert = "INSERT INTO $this->table (nombre_completo, direccion, telefono, ruta_id, poblacion_id) VALUES (?, ? ,?, ?, ?)";
            $colocadora = $this->ExecuteQuery($insert, [$nombre, $direccion, $telefono, $ruta_id, $poblacion_id]);

            if($colocadora) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha creado a la colocadora'
                ], 200);

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear a la colocadora'
                ], 400);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }


    public function edit($nombre, $direccion, $telefono, $ruta_id, $poblacion_id, $id){

        try{

            $update = "UPDATE  $this->table SET nombre_completo = ?, direccion = ?, telefono = ?, ruta_id = ?, poblacion_id = ? WHERE $this->table.id = '$id'";
            $colocadora = $this->ExecuteQuery($update, [$nombre, $direccion, $telefono, $ruta_id, $poblacion_id]);

            if($colocadora) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha actualizado a la colocadora'
                ], 200);

            } else {

                return json([
                    'status' => 'success', 
                    'data'=>null, 
                    'message'=>'No se actualizo nada nuevo'
                ], 200);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function desactivar($id){


        try{

            $update = "UPDATE $this->table SET status = 0 WHERE $this->table.id = ? and status = 1";
            $user = $this->ExecuteQuery($update, [$id]);

            if($user) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado a la colocadora'
                ], 200);

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error inesperado'
                ], 400);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }
       


    public function activar($id ){

        try{

            $update = "UPDATE $this->table SET status = 1 WHERE $this->table.id = ? and status = 0";
            $user = $this->ExecuteQuery($update, [$id]);

            if($user) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha activado a la colocadora'
                ], 200);

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error inesperado'
                ], 400);

            }

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }



}