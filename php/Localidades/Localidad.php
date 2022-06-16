<?php

include '../database.php';
include '../response.php';

class Localidad extends Database{

    private $table = 'localidades';

    public function index(){


        $query  = "SELECT * FROM $this->table ";
        $rutas =  $this->Select($query);
        
        return json(
            [
                'status' => 'success',
                'data' => $rutas,
                'message' => ''
            ]
        , 200);

    }

    public function localidadesRuta($id){

        $query  = "SELECT  $this->table.* FROM rutas
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