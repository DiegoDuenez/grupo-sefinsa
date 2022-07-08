<?php

require '../Clientes/Cliente.php';
require '../FileManager.php';
require './otropdf.php';

$id = $_POST['id'];

$pdf = new PDF();

$Cliente = new Cliente;

$cliente = $Cliente->getCliente($id);
$aval = $Cliente->getAvalCliente($id);

$pathComprobantes = "../../resources/comprobantes/clientes/".$cliente['carpeta_comprobantes'];
$pathGarantias = "../../resources/garantias/clientes/".$cliente['carpeta_garantias'];

$pathComprobantesAval = "../../resources/comprobantes/avales/".$aval['carpeta_comprobantes'];
$pathGarantiasAval = "../../resources/garantias/avales/".$aval['carpeta_garantias'];
    
$nombre_archivo = "Informacion_".$cliente['nombre_completo'].".pdf";

if(FileManager::getFiles($pathComprobantes) && FileManager::getFiles($pathGarantias) && FileManager::getFiles($pathComprobantesAval) && FileManager::getFiles($pathGarantiasAval) ){

    // DATOS DEL CLIENTE
    $pdf->AddPage('L', 'A4', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(280, 10, 'Datos del cliente', 1,0, 'C');
    $pdf->Ln();
    $w = 35;
    $h = 20;
    $x = $pdf->GetX();
    $header = ['Nombre', 'Direcci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Tel'.iconv( 'UTF-8', 'windows-1252', 'é' ).'fono', 'Garantias', 'Otras refs.' ,'Ruta', 'Poblaci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Colocadora'];
    for($i = 0; $i < count($header); $i++){
        $pdf->Cell(35, 10, $header[$i], 1,0, 'c');
    }

    $pdf->Ln();


    $pdf->SetFont('Arial', '', 12);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['nombre_completo']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['direccion']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['telefono']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['garantias']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['otras_referencias']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['nombre_ruta']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['nombre_poblacion']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $cliente['nombre_colocadora']);
    $pdf->Ln();

    $pdf->Ln();


    // DATOS AVAL
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(175, 10, 'Datos del aval', 1,0, 'C');
    $pdf->Ln();
    $x = $pdf->GetX();
    $header = ['Nombre', 'Direcci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Tel'.iconv( 'UTF-8', 'windows-1252', 'é' ).'fono', 'Garantias', 'Otras refs.'];
    for($i = 0; $i < count($header); $i++){
        $pdf->Cell(35, 10, $header[$i], 1,0, 'c');
    }

    $pdf->Ln();


    $pdf->SetFont('Arial', '', 12);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $aval['nombre_completo']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $aval['direccion']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $aval['telefono']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $aval['garantias']);
    $x = $pdf->GetX();
    $pdf->myCell($w, $h, $x, $aval['otras_referencias']);
    $x = $pdf->GetX();

    $pdf->Ln();




    for($i = 2; $i < count(FileManager::getFiles($pathComprobantes)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Comprobantes cliente " . $cliente['nombre_completo']);
        }
        $pdf-> Image($pathComprobantes.'/'.FileManager::getFiles($pathComprobantes)[$i],35,35,150,150);

    }
    for($i = 2; $i < count(FileManager::getFiles($pathGarantias)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Garantias cliente " . $cliente['nombre_completo']);
        }
        $pdf-> Image($pathGarantias.'/'.FileManager::getFiles($pathGarantias)[$i],35,35,150,150);

    }

    for($i = 2; $i < count(FileManager::getFiles($pathComprobantesAval)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Comprobantes aval " . $aval['nombre_completo']);
        }
        $pdf-> Image($pathComprobantesAval.'/'.FileManager::getFiles($pathComprobantesAval)[$i],35,35,150,150);

    }
    for($i = 2; $i < count(FileManager::getFiles($pathGarantiasAval)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Garantias aval " . $aval['nombre_completo']);
        }
        $pdf-> Image($pathGarantiasAval.'/'.FileManager::getFiles($pathGarantiasAval)[$i],35,35,150,150);

    }

    $pdf->Output('D', $nombre_archivo);


}