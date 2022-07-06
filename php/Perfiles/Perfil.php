<?php

include '../database.php';
include '../response.php';

class Perfil extends Database{

    private $table = 'perfiles';

    public function index()
    {

        $query = "SELECT * FROM $this->table ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre_perfil, $tipo_perfil){

        try{

            if(!$this->existsData('perfiles', 'nombre_perfil', trim($nombre_perfil))){

                $insert = "INSERT INTO $this->table (nombre_perfil, tipo_perfil) VALUES (?, ?)";
                $perfil = $this->ExecuteQuery($insert, [$nombre_perfil, $tipo_perfil]);

               if($perfil) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado el perfil'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear perfil'
                    ], 400);

                }


            }
            else{

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El nombre de perfil ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function edit($id, $nombre_perfil, $tipo_perfil){

        try{

            if(!$this->existsData('perfiles', 'nombre_perfil', trim($nombre_perfil), $id)){

                $update = "UPDATE $this->table SET nombre_perfil = ?, tipo_perfil = ? WHERE $this->table.id = '$id'";
                $user = $this->ExecuteQuery($update, [$nombre_perfil, $tipo_perfil]);

                if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado el perfil'
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
                    'message'=>'El nombre de perfil ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }


}