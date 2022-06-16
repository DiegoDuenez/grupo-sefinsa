<?php

include '../database.php';
include '../response.php';

class Localidad extends Database{

    private $table = 'localidades';

    public function index(){


        //$query  = "SELECT * FROM $this->table ";
        $query = "SELECT  $this->table.*, rutas.nombre_ruta FROM rutas
        INNER JOIN ruta_localidades ON rutas.id = ruta_localidades.ruta_id 
        INNER JOIN localidades ON  $this->table.id = ruta_localidades.localidad_id ORDER BY $this->table.id DESC ";

        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre, $ruta_id){

        try{

            if(!$this->existsData('localidades', 'nombre_localidad', trim($nombre))){

                $insert = "INSERT INTO $this->table (nombre_localidad) VALUES (?)";
                $localidad = $this->ExecuteQuery($insert, [$nombre]);

                $insert2 = "INSERT INTO ruta_localidades (ruta_id, localidad_id) VALUES (?,?)";
                $localidad_ruta = $this->ExecuteQuery($insert2, [$ruta_id, $this->lastInsertId()]);

               if($localidad && $localidad_ruta) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado la localidad'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear la localidad'
                    ], 400);

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

    public function edit($nombre, $ruta_id, $id){

        try{

            if(!$this->existsData('localidades', 'nombre_localidad', trim($nombre), $id)){

                $update = "UPDATE $this->table SET nombre_localidad = ? WHERE id = '$id'";
                $localidad = $this->ExecuteQuery($update, [$nombre]);

                $select = "SELECT $this->table.id FROM $this->table WHERE nombre_localidad = '$nombre' LIMIT 1";
                $id = $this->SelectOne($select);

                $update2 = "UPDATE ruta_localidades SET ruta_id = ? WHERE localidad_id = '" . $id['id']. "'";
                $localidad_ruta = $this->ExecuteQuery($update2, [$ruta_id]);

               if($localidad && $localidad_ruta) {

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