<?php

include '../database.php';
include '../response.php';

class Ruta extends Database{

    private $table = 'rutas';

    public function index(){

        /*$query  = "SELECT $this->table.*, localidades.id as localidad_id, localidades.nombre_localidad FROM $this->table 
        INNER JOIN ruta_localidades ON $this->table.id = ruta_localidades.ruta_id 
        INNER JOIN localidades ON localidades.id = ruta_localidades.localidad_id";*/

        $query  = "SELECT * FROM $this->table ";
        $rutas =  $this->Select($query);
        /*$rutas = json_decode($rutas, TRUE);
        $rutas[] = ['id' => '9999', 'name' => 'Name'];
        $json = json_encode($rutas);*/
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre){

        try{

            if(!$this->existsData('rutas', 'nombre_ruta', trim($nombre))){

                $insert = "INSERT INTO $this->table (nombre_ruta) VALUES (?)";
                $user = $this->ExecuteQuery($insert, [$nombre]);

               if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado la ruta'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear ruta'
                    ], 400);

                }


            }
            else{

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El nombre de ruta ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function edit($nombre, $id){

        try{

            if(!$this->existsData('rutas', 'nombre_ruta', trim($nombre), $id)){

                $update = "UPDATE $this->table SET nombre_ruta = ? WHERE id = '$id'";
                $user = $this->ExecuteQuery($update, [$nombre]);

               if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha editado la ruta'
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
                    'message'=>'El nombre de ruta ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function localidadesRuta($id){

        $query  = "SELECT localidades.* FROM $this->table 
        INNER JOIN ruta_localidades ON $this->table.id = ruta_localidades.ruta_id 
        INNER JOIN localidades ON localidades.id = ruta_localidades.localidad_id WHERE
        $this->table.id = '$id'";

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