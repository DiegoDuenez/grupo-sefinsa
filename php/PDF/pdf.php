<?php

require '../Clientes/Cliente.php';
require '../FileManager.php';
require '../fpdf/fpdf.php';

$id = $_POST['id'];

$pdf = new FPDF();

$Cliente = new Cliente;

$cliente = $Cliente->getCliente($id);
$pathComprobantes = "../../resources/comprobantes/clientes/".$cliente['carpeta_comprobantes'];
$pathGarantias = "../../resources/garantias/clientes/".$cliente['carpeta_garantias'];

    
$nombre_archivo = "Informacion_".$cliente['nombre_completo'].".pdf";

if(FileManager::getFiles($pathComprobantes) && FileManager::getFiles($pathGarantias)){

    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(60,20,$id . " " . $cliente['nombre_completo']);

    
    for($i = 2; $i < count(FileManager::getFiles($pathComprobantes)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Comprobantes");
        }
        $pdf-> Image($pathComprobantes.'/'.FileManager::getFiles($pathComprobantes)[$i],35,35,150,150);

    }
    for($i = 2; $i < count(FileManager::getFiles($pathGarantias)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        if($i == 2){
            $pdf->Cell(60,20,"Garantias");
        }
        $pdf-> Image($pathGarantias.'/'.FileManager::getFiles($pathGarantias)[$i],35,35,150,150);

    }
    $pdf->Output('D', $nombre_archivo);
    
      

}
else{
    echo "No se encontro el directorio de archivo solicitado.";
    die();
}

