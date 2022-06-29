<?php

include '../database.php';
include '../response.php';

class Ruta extends Database{

    private $table = 'rutas';

    public function index(){

        /*$query  = "SELECT $this->table.*, empleados.nombre_completo, empleados.status as 'empleado_status'  FROM $this->table  
        INNER JOIN empleados ON $this->table.empleado_id = empleados.id
        ORDER BY $this->table.id DESC";*/

        $query = "SELECT $this->table.*,
        GROUP_CONCAT(empleados.nombre_completo SEPARATOR ', ') as empleados,
        GROUP_CONCAT(empleados.id SEPARATOR ', ') as empleados_id,
        GROUP_CONCAT(concat('(',perfiles.nombre_perfil,')') SEPARATOR ', ') as perfiles,
        empleados.status as 'empleado_status'
        FROM $this->table 
        INNER JOIN rutas_empleados as re ON re.ruta_id = $this->table.id
        INNER JOIN empleados ON re.empleado_id = empleados.id
        INNER JOIN perfiles ON empleados.perfil_id = perfiles.id
        GROUP BY $this->table.id
        ORDER BY $this->table.id DESC
        ";

        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function rutasActivas(){

        $query  = "SELECT * FROM $this->table WHERE $this->table.status = 1 
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

    public function create($nombre, $empleados){

        try{

            if(!$this->existsData('rutas', 'nombre_ruta', trim($nombre))){


                $insert = "INSERT INTO $this->table (nombre_ruta, empleado_id) VALUES (?,?)";
                $ruta = $this->ExecuteQuery($insert, [$nombre, 1]);

                $query = "SELECT id FROM $this->table ORDER BY id DESC LIMIT 1";
                $ruta = $this->SelectOne($query);

                for($i = 0; $i < count($empleados); $i++)
                {
                    $insertRE = "INSERT INTO rutas_empleados (ruta_id, empleado_id) VALUES (?, ?)";
                    $rutaInserta = $this->ExecuteQuery($insertRE, [$ruta['id'], $empleados[$i]]);
                }


                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha creado la ruta'
                ], 200);
                

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

    public function edit($nombre,  $empleados , $id){

        try{

            if(!$this->existsData('rutas', 'nombre_ruta', trim($nombre), $id)){

                $update = "UPDATE $this->table SET nombre_ruta = ?, empleado_id = ? WHERE id = '$id'";
                $r = $this->ExecuteQuery($update, [$nombre, 1]);

                $dropQuery = "DELETE FROM rutas_empleados WHERE ruta_id = '$id'";
                $r = $this->ExecuteQuery($dropQuery, []);

               for($i = 0; $i < count($empleados); $i++)
                {
                    $insertRE = "INSERT INTO rutas_empleados (ruta_id, empleado_id) VALUES (?, ?)";
                    $rutaInserta = $this->ExecuteQuery($insertRE, [$id, $empleados[$i]]);
                   
                }
                
                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha editado la ruta'
                ], 200);


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


    public function desactivar($id){


        try{

            $query = "SELECT count(*) as 'cantidadLocalidades' FROM ruta_localidades WHERE ruta_localidades.ruta_id = '$id' ";
            $rutas = $this->SelectOne($query);

            $query2 = "SELECT count(*) as 'cantidadEmpleados' FROM rutas_empleado WHERE rutas_empleado.ruta_id = '$id' ";
            $rutas2 = $this->SelectOne($query2);

            if($rutas['cantidadLocalidades'] == 0 && $rutas2['cantidadEmpleados'] == 0){

                $update = "UPDATE $this->table SET status = 0 WHERE $this->table.id = ? and status = 1";
                $user = $this->ExecuteQuery($update, [$id]);
    
                if($user) {
    
                    return json([
                        'status' => 'success', 
                        'data'=> null, 
                        'message'=> 'Se ha desactivado la ruta '
                    ], 200);
    
                } else {
    
                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=>'Error inesperado'
                    ], 400);
    
                }

            }
            else{

                if( $rutas['cantidadLocalidades'] > 0){
                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=> 'No puedes desactivar esta ruta ya que hay ' . $rutas['cantidadLocalidades'] .' localidades que pertenencen a ella.' 
                    ], 400);
                }
                else if($rutas2['cantidadEmpleados'] > 0){
                    return json([
                        'status' => 'error', 
                        'data'=>null, 
                        'message'=> 'No puedes desactivar esta ruta ya que hay ' . $rutas2['cantidadEmpleados'] .' empleados que pertenencen a ella.' 
                    ], 400);
                }
                

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
                    'message'=> 'Se ha activado la ruta'
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