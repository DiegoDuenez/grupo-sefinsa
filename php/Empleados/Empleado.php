<?php

include '../database.php';
include '../response.php';

class Empleado extends Database{

    private $table = 'empleados';

    public function index()
    {

        $query  = "SELECT $this->table.*, perfiles.nombre_perfil FROM $this->table INNER JOIN perfiles on perfiles.id = $this->table.perfil_id ORDER BY $this->table.id DESC";
        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function create($nombre, $usuario, $password, $perfil_id){

        try{

            if(!$this->existsData('empleados', 'usuario', $usuario)){

                $password = password_hash($password, PASSWORD_DEFAULT);
                $insert = "INSERT INTO $this->table (nombre_completo, usuario, password, perfil_id) VALUES (?, ? ,?, ?)";
                $user = $this->ExecuteQuery($insert, [$nombre, $usuario, $password, $perfil_id]);

               if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado al empleado'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear empleado'
                    ], 400);

                }


            }
            else{

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'El nombre de usuario ya fue registrado'
                ], 400);

            }
            

        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function perfiles(){

        $query  = "SELECT * FROM perfiles ORDER BY id DESC";
        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }
}
