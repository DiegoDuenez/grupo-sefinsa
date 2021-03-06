<?php

include '../database.php';
include '../response.php';

class Usuario extends Database{

    private $table = 'users';

    public function index()
    {

        $query  = "SELECT $this->table.*, perfiles.nombre_perfil FROM $this->table 
        INNER JOIN perfiles ON perfiles.id = $this->table.perfil_id
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

            if(!$this->existsData('users', 'usuario', trim($usuario))){

                $password = password_hash($password, PASSWORD_DEFAULT);
                $insert = "INSERT INTO $this->table (nombre_completo, usuario, password, perfil_id) VALUES (?, ? ,?, ?)";
                $user = $this->ExecuteQuery($insert, [trim($nombre), trim($usuario), trim($password), trim($perfil_id)]);

               if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha creado al usuario'
                    ], 200);

                } else {

                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error al crear usuario'
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

    public function edit($nombre, $usuario, $password, $id, $changePassword, $perfil_id){

        try{

            if(!$this->existsData('users', 'usuario', trim($usuario), $id)){

                if($changePassword){

                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $update = "UPDATE $this->table SET usuario = ?, nombre_completo = ?, password = ?, perfil_id = ? WHERE users.id = '$id'";
                    $user = $this->ExecuteQuery($update, [trim($usuario), trim($nombre), trim($password), trim($perfil_id)]);

                }
                else{
                    $update = "UPDATE $this->table SET usuario = ?, nombre_completo = ?, perfil_id = ? WHERE users.id = '$id'";
                    $user = $this->ExecuteQuery($update, [trim($usuario), trim($nombre), trim($perfil_id)]);
                }


               if($user) {

                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha actualizado al usuario'
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

    public function login($usuario, $password){


        $query = "SELECT *,
        GROUP_CONCAT(modulos.nombre_modulo SEPARATOR ', ') as modulos
        FROM $this->table
        INNER JOIN perfiles ON perfiles.id = $this->table.perfil_id
        INNER JOIN perfiles_modulos ON perfiles_modulos.perfil_id = perfiles.id
        INNER JOIN modulos ON perfiles_modulos.modulo_id = modulos.id
        WHERE usuario = '$usuario' and $this->table.status = 1 limit 1";
        $user = $this->SelectOne($query);

        if($user){
            if(password_verify($password, $user['password'])){
                return json(
                    [
                        'status' => 'success',
                        'data' => $this->SelectOne($query),
                        'message' => ''
                    ]
                , 200);
            }
            else{
                return json(
                    [
                        'status' => 'error',
                        'data' => null,
                        'message' => 'Datos incorrectos'
                    ]
                , 404);
            }
        }
        else{
            return json(
                [
                    'status' => 'error',
                    'data' => null,
                    'message' => 'No se encontro ningun usuario'
                ]
            , 404);
        }

        
        


    }

    public function desactivar($id){


        try{

            $update = "UPDATE $this->table SET status = 0 WHERE users.id = ? and status = 1";
            $user = $this->ExecuteQuery($update, [$id]);

            if($user) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado al usuario'
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

            $update = "UPDATE $this->table SET status = 1 WHERE users.id = ? and status = 0";
            $user = $this->ExecuteQuery($update, [$id]);

            if($user) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha activado al usuario'
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