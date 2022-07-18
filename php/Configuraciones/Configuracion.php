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

    public function createAbonos($cantidad, $tipo_cantidad, $descripcion, $de, $por_cada){

        try{


            $insert = "INSERT INTO configuracion_abonos (cantidad, tipo_cantidad, descripcion, de, por_cada) VALUES (?, ?, ?, ?, ?)";
            $localidad = $this->ExecuteQuery($insert, [$cantidad, $tipo_cantidad, $descripcion, $de, $por_cada]);

            if($localidad) {

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

}