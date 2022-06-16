<?php

include '../database.php';
include '../response.php';

class Empleado extends Database{

    private $table = 'empleados';

    public function index()
    {

        $query  = "SELECT $this->table.*, perfiles.nombre_perfil FROM $this->table 
        INNER JOIN perfiles on perfiles.id = $this->table.perfil_id 
        ORDER BY $this->table.id DESC";
        
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

    public function edit($nombre, $usuario, $password, $perfil_id, $id, $changePassword){

        try{

            if(!$this->existsData('empleados', 'usuario', trim($usuario), $id)){

                if($changePassword){

                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $update = "UPDATE $this->table SET usuario = ?, nombre_completo = ?, password = ?, perfil_id = ? WHERE $this->table.id = '$id'";
                    $user = $this->ExecuteQuery($update, [$usuario, $nombre, $password, $perfil_id]);

                }
                else{
                    $update = "UPDATE $this->table SET usuario = ?, nombre_completo = ?, perfil_id = ? WHERE $this->table.id = '$id'";
                    $user = $this->ExecuteQuery($update, [$usuario, $nombre, $perfil_id]);
                }

                if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado al empleado'
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

    public function desactivar($id){


        try{

            $update = "UPDATE $this->table SET status = 0 WHERE $this->table.id = ? and status = 1";
            $user = $this->ExecuteQuery($update, [$id]);

            if($user) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado al empleado'
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
                    'message'=> 'Se ha activado al empleado'
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
