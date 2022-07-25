<?php

include '../database.php';
include '../response.php';

class Modulo extends Database{

    public function index()
    {
        $query = "SELECT * FROM modulos";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
    }

    public function modulosActivos()
    {
        $query = "SELECT * FROM modulos WHERE status = 1";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
    }

}