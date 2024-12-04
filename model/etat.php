<?php
include_once 'fonction.php';
include_once '../include/fpdf/fpdf.php';

// Récupérer l'année ou le mois sélectionné
$statut = $_GET['stat'];
$nom_mois = [
    1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin",
    7 => "Juillet", 8 => "Août", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre"
];

// Créer le document PDF
$pdf = new FPDF();
$pdf->AddPage();

// Définir la police pour l'en-tête
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 102, 204); // Couleur bleue pour le texte
$pdf->Cell(0, 10, 'DPL (Direction Promotion de Loisir)', 0, 1, 'L'); // à gauche
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, utf8_decode('Rapport '. ucfirst($statut)), 0, 1, 'C'); // Centré
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(10); // Saut de ligne

// Traitement annuel
if ($statut == 'annuel') {
    $annee = $_POST['annee'];
    $activite = get_activite_on_annee($annee);
    
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40, 10, utf8_decode('Année '.$annee), 0, 1, 'C', true);
    $pdf->SetFont('Arial', 'B', 12);
    // Table Header avec fond bleu et texte blanc
    $pdf->SetFillColor(0, 102, 204); // Couleur de fond bleue pour l'en-tête
    $pdf->SetTextColor(255, 255, 255); // Texte en blanc
    $pdf->Cell(50, 10, utf8_decode('Déscription'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Responsable'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Date Début'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, 'Date Fin', 0, 0, 'C', true);
    $pdf->Cell(20, 10, 'Statut', 0, 1, 'C', true);

    // Remplir les données avec des lignes alternées
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Texte en noir pour les données
    $i = 0; // Compteur pour changer la couleur des lignes
    foreach ($activite as $row) {
        $pdf->SetFillColor($i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240); // Lignes alternées
        $pdf->Cell(50, 10, utf8_decode($row['description']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_d']), 0, 0, 'C', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_f']), 0, 0, 'C', true);

        // Déterminer le statut
        $status = get_statut($row['date_d'], $row['date_f'], $row['expired']);        

        $pdf->Cell(20, 10, utf8_decode($status), 0, 1, 'C', true);
        $i++;
    }

} elseif ($statut == 'mensuel') {
    $date = $_POST['mois']; // Assurez-vous que $mois est correctement envoyé via POST
    // var_dump($mois);
    // Utilisation de la fonction explode pour séparer l'année et le mois
    list($year, $month) = explode('-', $date);

    // echo "Année: " . $year . "\n";
    // echo "Mois: " . $month . "\n";
    $activite = get_activite_mensuel($year,$month);
    // var_dump($activite);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40, 10, utf8_decode('Mois de '.$nom_mois[$month]), 0, 1, 'C', true);
    // Table Header avec fond bleu et texte blanc
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 102, 204); // Couleur de fond bleue pour l'en-tête
    $pdf->SetTextColor(255, 255, 255); // Texte en blanc
    $pdf->Cell(50, 10, utf8_decode('Déscription'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Responsable'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Date Début'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, 'Date Fin', 0, 0, 'C', true);
    $pdf->Cell(20, 10, 'Statut', 0, 1, 'C', true);
    // Remplir les données avec des lignes alternées
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Texte en noir pour les données
    $i = 0;
    foreach ($activite as $row) {
        $pdf->SetFillColor($i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240); // Lignes alternées
        $pdf->Cell(50, 10, utf8_decode($row['description']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_d']), 0, 0, 'C', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_f']), 0, 0, 'C', true);
        $status = 'Non défini';

        // Déterminer le statut
        // Déterminer le statut
        $status = get_statut($row['date_d'], $row['date_f'], $row['expired']);
        $pdf->Cell(20, 10, utf8_decode($status), 0, 1, 'C', true);
        $i++;
    }


} else {
    // Traitement hebdomadaire
    $date = $_POST['date'];
    $activite = get_activite_ebdomadaire($date);
    $date_lundi = lundi_de_semaine($date);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(100, 10, utf8_decode('Semaine du Lundi '.$date_lundi['jour'] .' '.$nom_mois[$date_lundi['mois']] .' '.$date_lundi['annee']), 0, 1, 'C', true);
    // Table Header avec fond bleu et texte blanc
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 102, 204); // Couleur de fond bleue pour l'en-tête
    $pdf->SetTextColor(255, 255, 255); // Texte en blanc
    $pdf->Cell(50, 10, utf8_decode('Déscription'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Responsable'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Date Début'), 0, 0, 'C', true);
    $pdf->Cell(40, 10, 'Date Fin', 0, 0, 'C', true);
    $pdf->Cell(20, 10, 'Statut', 0, 1, 'C', true);

    // Remplir les données avec des lignes alternées
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Texte en noir pour les données
    $i = 0;
    foreach ($activite as $row) {
        $pdf->SetFillColor($i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240, $i % 2 == 0 ? 255 : 240); // Lignes alternées
        $pdf->Cell(50, 10, utf8_decode($row['description']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 0, 0, 'L', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_d']), 0, 0, 'C', true);
        $pdf->Cell(40, 10, transformDateFormat($row['date_f']), 0, 0, 'C', true);

        // Déterminer le statut
        $status = get_statut($row['date_d'], $row['date_f'], $row['expired']);
        $pdf->Cell(20, 10, utf8_decode($status), 0, 1, 'C', true);
        $i++;
    }
}

// Sortie du PDF
$pdf->Output();
?>
