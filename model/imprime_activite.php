<?php
include_once 'fonction.php';
include_once '../include/fpdf/fpdf.php';
if(!empty($_GET['all'])){
    $activite = get_activite();
    // var_dump($activite);
    // Create PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set font for table header
    $pdf->SetFont('Arial', 'B', 12);
    
    // Table header
    $header = ['ID', 'Déscription', 'Responsable', 'Date Début', 'Date Fin'];
    
    $pdf->Cell(20, 10, utf8_decode($header[0]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[1]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[2]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[3]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[4]), 1);
    
    $pdf->Ln();
    
    // Table data
    $pdf->SetFont('Arial', '', 10);
    foreach($activite as $value){
        $pdf->Cell(20, 10, $value['id_a'], 1);
        $pdf->Cell(40, 10, $value['description'], 1);
        $pdf->Cell(40, 10, $value['nom_p'], 1);
        $pdf->Cell(40, 10, $value['date_d'], 1);
        $pdf->Cell(40, 10, $value['date_f'], 1);
        $pdf->Ln();
    
    }
    $pdf->Output();
}else{
    $id = $_GET['id'];
    // Retrieve activity data
    $activite = get_activite($id);
    
    // Create PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set font for table header
    $pdf->SetFont('Arial', 'B', 12);
    
    // Table header
    $header = ['ID', 'Déscription', 'Responsable', 'Date Début', 'Date Fin'];
    
    $pdf->Cell(10, 10, utf8_decode($header[0]), 1);
    $pdf->Cell(30, 10, utf8_decode($header[1]), 1);
    $pdf->Cell(30, 10, utf8_decode($header[2]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[3]), 1);
    $pdf->Cell(40, 10, utf8_decode($header[4]), 1);
    
    $pdf->Ln();
    
    $date_d = date('j F Y', strtotime($activite['date_d']));
    $date_f = date('j F Y', strtotime($activite['date_f']));
    // Table data
    $pdf->SetFont('Arial', '', 10);
    
        $pdf->Cell(10, 10, $activite['id_a'], 1);
        $pdf->Cell(30, 10, $activite['description'], 1);
        $pdf->Cell(30, 10, $activite['nom_p'], 1);
        $pdf->Cell(40, 10, $date_d, 1);
        $pdf->Cell(40, 10, $date_f, 1);
        $pdf->Ln();
    
    $pdf->Output();
    
}
