<?php


include '../database.php';
include '../response.php';

class Configuracion extends Database{

    private $table = 'configuracion_';

    public function index($tipo)
    {

        if($tipo == "semanas"){
            $query = "SELECT $this->table$tipo.*, configuracion_abonos.descripcion as abono_descripcion FROM $this->table$tipo
            INNER JOIN configuracion_abonos ON $this->table$tipo.tipo_abono = configuracion_abonos.id
            ORDER BY id DESC";
        }
        else{
            $query = "SELECT * FROM $this->table$tipo ORDER BY id DESC";

        }

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function getMultaPorDefecto(){

        $query = "SELECT * FROM configuracion_multa ORDER BY id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->SelectOne($query),
                'message' => ''
            ]
        , 200);
    }

    public function abonosActivos(){

        $query = "SELECT * FROM configuracion_abonos WHERE status = 1 ORDER BY id DESC";

        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);

    }

    public function semanasActivas(){

        $query = "SELECT configuracion_semanas.*, configuracion_abonos.cantidad as 'cantidad_abono' ,  configuracion_abonos.tipo_cantidad, 
        configuracion_abonos.de, configuracion_abonos.por_cada, 
        configuracion_abonos.descripcion as abono_descripcion FROM configuracion_semanas
        INNER JOIN configuracion_abonos ON configuracion_semanas.tipo_abono = configuracion_abonos.id
        WHERE configuracion_semanas.status = 1
        ORDER BY id DESC";
        
        return json(
            [
                'status' => 'success',
                'data' => $this->Select($query),
                'message' => ''
            ]
        , 200);
    }

    public function buscarSemana($id){

        $query = "SELECT configuracion_semanas.*, configuracion_abonos.cantidad as 'cantidad_abono' ,  configuracion_abonos.tipo_cantidad, 
        configuracion_abonos.de, configuracion_abonos.por_cada, 
        configuracion_abonos.descripcion as abono_descripcion FROM configuracion_semanas
        INNER JOIN configuracion_abonos ON configuracion_semanas.tipo_abono = configuracion_abonos.id
        WHERE configuracion_semanas.id = '$id'
        LIMIT 1";
        
        return json(
            [
                'status' => 'success',
                'data' => $this->SelectOne($query),
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
                    'message'=>'Error al crear abono'
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
                    'message'=> 'Se ha editado un abono'
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


    /* SEMANAS  */
    public function createSemana($cantidad, $interes, $tipo_abono, $semana_renovacion){

        try{


            $insert = "INSERT INTO configuracion_semanas (cantidad, interes, tipo_abono, semana_renovacion) VALUES (?, ?, ?, ?)";
            $abono = $this->ExecuteQuery($insert, [$cantidad, $interes, $tipo_abono, $semana_renovacion]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha creado la cantidad de semanas'
                ], 200);

            } else {

                return json([
                    'status' => 'error', 
                    'data'=>null, 
                    'message'=>'Error al crear cantidad de semanas'
                ], 400);

            }


        } catch(Exception $e) {

            return $e->getMessage();
            die();

        }

    }

    public function editSemana($id, $cantidad, $interes, $tipo_abono, $semana_renovacion){

        try{


            $update = "UPDATE configuracion_semanas SET cantidad = ?, interes = ?, tipo_abono = ?, semana_renovacion = ? WHERE id = '$id'";
            $abono = $this->ExecuteQuery($update, [$cantidad, $interes, $tipo_abono, $semana_renovacion]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha editado'
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

    public function desactivarSemana($id){


        try{

            $update = "UPDATE configuracion_semanas SET status = 0 WHERE id = ? and status = 1";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado el registro'
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
       


    public function activarSemana($id){

      

        try{

            $update = "UPDATE configuracion_semanas SET status = 1 WHERE id = ? and status = 0";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha activado el registro'
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


    /* MULTA */

    public function editMulta($id, $cantidad){

        try{


            $update = "UPDATE configuracion_multa SET cantidad = ? WHERE id = '$id'";
            $abono = $this->ExecuteQuery($update, [$cantidad]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha editado la multa por defecto'
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

    public function desactivarMulta($id){


        try{

            $update = "UPDATE configuracion_multa SET status = 0 WHERE id = ? and status = 1";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha desactivado el registro'
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
       


    public function activarMulta($id){

      

        try{

            $update = "UPDATE configuracion_multa SET status = 1 WHERE id = ? and status = 0";
            $abono = $this->ExecuteQuery($update, [$id]);

            if($abono) {

                return json([
                    'status' => 'success', 
                    'data'=> null, 
                    'message'=> 'Se ha activado el registro'
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