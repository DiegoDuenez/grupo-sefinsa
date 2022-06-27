<?php

require '../Clientes/Cliente.php';
require '../FileManager.php';
require '../fpdf/fpdf.php';

$id = $_POST['id'];

$pdf = new FPDF();

$Cliente = new Cliente;

$cliente = $Cliente->getCliente($id);
$path = "../../resources/comprobantes/clientes/".$cliente['carpeta_comprobantes'];
    
if(FileManager::getFiles($path)){

    
    for($i = 2; $i < count(FileManager::getFiles($path)); $i++){

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(60,20,$id);
        $pdf-> Image($path.'/'.FileManager::getFiles($path)[$i],35,35,150,150);

    }
    $pdf->Output('D','test.pdf');
    
      

}
else{

    echo json([
        'status'=>'error',
        'data'=> "La ruta $path no fue encontrada.",
        'message'=>''
    ], 404);

}

