<?php

require '../Clientes/Cliente.php';
require '../FileManager.php';
require '../fpdf/fpdf.php';

$id = $_POST['id'];

$pdf = new FPDF();

$Cliente = new Cliente;

$cliente = $Cliente->getCliente($id);
$aval = $Cliente->getAvalCliente($id);
$pathComprobantes = "../../resources/comprobantes/clientes/".$cliente['carpeta_comprobantes'];
$pathGarantias = "../../resources/garantias/clientes/".$cliente['carpeta_garantias'];

$pathComprobantesAval = "../../resources/comprobantes/avales/".$aval['carpeta_comprobantes'];
$pathGarantiasAval = "../../resources/garantias/avales/".$aval['carpeta_garantias'];
    
$nombre_archivo = "Informacion_".$cliente['nombre_completo'].".pdf";

if(FileManager::getFiles($pathComprobantes) && FileManager::getFiles($pathGarantias)){

    
    // DATOS DEL CLIENTE
    $pdf->AddPage('L', 'A4', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(280, 10, 'Datos del cliente', 1,0, 'C');
    $pdf->Ln();

    $header = ['Nombre', 'Direcci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Tel'.iconv( 'UTF-8', 'windows-1252', 'é' ).'fono', 'Garantias', 'Otras refs.' ,'Ruta', 'Poblaci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Colocadora'];
    for($i = 0; $i < count($header); $i++){
        $pdf->Cell(35, 10, $header[$i], 1,0, 'c');
    }

    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $w = 35;
    $pdf->MultiCell($w, 10, $cliente['nombre_completo'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['direccion'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['telefono'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['garantias'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['otras_referencias'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['nombre_ruta'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['nombre_poblacion'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $cliente['nombre_colocadora'], 1);

    $pdf->Ln();


    // DATOS DEL AVAL

    $pdf->AddPage('L', 'A4', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(175, 10, 'Datos del aval', 1,0, 'C');
    $pdf->Ln();

    $header = ['Nombre', 'Direcci'.iconv( 'UTF-8', 'windows-1252', 'ó' ).'n', 'Tel'.iconv( 'UTF-8', 'windows-1252', 'é' ).'fono', 'Garantias', 'Otras refs.'];
    for($i = 0; $i < count($header); $i++){
        $pdf->Cell(35, 10, $header[$i], 1,0, 'c');
    }

    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $w = 20;
    $pdf->MultiCell($w, 10, $aval['nombre_completo'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $aval['direccion'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $aval['telefono'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $aval['garantias'], 1);
    $pdf->SetXY($x + $w, $y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 10, $aval['otras_referencias'], 1);
    

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
else{
    echo "No se encontro el directorio solicitado.";
    echo '
    <script>
    setTimeout(function(){
       window.location.href = "http://localhost/proyecto_cobranza/clientes.php";
    }, 1000);
    </script>';
    die();
}

