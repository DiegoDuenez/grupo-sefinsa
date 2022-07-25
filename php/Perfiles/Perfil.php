<?php

include '../database.php';
include '../response.php';

class Perfil extends Database{

    private $table = 'perfiles';

    public function index()
    {

        $query = "SELECT $this->table.*,
        GROUP_CONCAT(modulos.nombre_modulo SEPARATOR ', ') as modulos,
        GROUP_CONCAT(modulos.id SEPARATOR ', ') as modulos_id
        FROM $this->table
        INNER JOIN perfiles_modulos ON perfiles_modulos.perfil_id = $this->table.id
        LEFT JOIN modulos ON perfiles_modulos.modulo_id = modulos.id
        GROUP BY $this->table.id
        ORDER BY $this->table.id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre_perfil, $tipo_perfil, $modulos){

        try{

            if(!$this->existsData('perfiles', 'nombre_perfil', trim($nombre_perfil))){

                $insert = "INSERT INTO $this->table (nombre_perfil, tipo_perfil) VALUES (?, ?)";
                $perfil = $this->ExecuteQuery($insert, [$nombre_perfil, $tipo_perfil]);

                $query = "SELECT id FROM $this->table ORDER BY id DESC LIMIT 1";
                $perfil = $this->SelectOne($query);

               if($perfil) {

                    for($i = 0; $i < count($modulos); $i++)
                    {
                        $insertPM = "INSERT INTO perfiles_modulos (perfil_id, modulo_id) VALUES (?, ?)";
                        $perfilInserta = $this->ExecuteQuery($insertPM, [$perfil['id'], $modulos[$i]]);
                    }

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

    public function edit($id, $nombre_perfil, $tipo_perfil, $modulos){

        try{

            if(!$this->existsData('perfiles', 'nombre_perfil', trim($nombre_perfil), $id)){

                $update = "UPDATE $this->table SET nombre_perfil = ?, tipo_perfil = ? WHERE $this->table.id = '$id'";
                $user = $this->ExecuteQuery($update, [$nombre_perfil, $tipo_perfil]);


                $dropQuery = "DELETE FROM perfiles_modulos WHERE perfil_id = '$id'";
                $p = $this->ExecuteQuery($dropQuery, []);

                for($i = 0; $i < count($modulos); $i++)
                {
                    $insertPM = "INSERT INTO perfiles_modulos (perfil_id, modulo_id) VALUES (?, ?)";
                    $perfilInserta = $this->ExecuteQuery($insertPM, [$id, $modulos[$i]]);
                }


                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha actualizado el perfil'
                ], 200);


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