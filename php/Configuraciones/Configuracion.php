<?php


include '../database.php';
include '../response.php';

class Configuracion extends Database{

    private $table = 'configuracion_';

    public function index($tipo)
    {

        $query = "SELECT * FROM $this->table$tipo ORDER BY id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function createAbono($cantidad, $tipo_cantidad, $descripcion, $de, $por_cada){

        try{


            $insert = "INSERT INTO configuracion_abonos (cantidad, tipo_cantidad, descripcion, de, por_cada) VALUES (?, ?, ?, ?, ?)";
            $abono = $this->ExecuteQuery($insert, [$cantidad, $tipo_cantidad, $descripcion, $de, $por_cada]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha creado un abono'
                ], 200);

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear abobo'
                ], 400);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function editAbono($id, $cantidad, $tipo_cantidad, $descripcion, $de, $por_cada){

        try{


            $update = "UPDATE configuracion_abonos SET cantidad = ?, tipo_cantidad = ?, descripcion = ?, de = ?, por_cada = ? WHERE id = '$id'";
            $abono = $this->ExecuteQuery($update, [$cantidad, $tipo_cantidad, $descripcion, $de, $por_cada]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha creado un abono'
                ], 200);

            } else {

                return json([
                    'status' => 'success', 
                    'data'=>null, 
                    'message'=>'No se cambio nada nuevo'
                ], 200);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function desactivarAbono($id){


        try{

            $update = "UPDATE configuracion_abonos SET status = 0 WHERE id = ? and status = 1";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado el abono'
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
       


    public function activarAbono($id ){

      

        try{

            $update = "UPDATE configuracion_abonos SET status = 1 WHERE id = ? and status = 0";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha activado el abono'
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