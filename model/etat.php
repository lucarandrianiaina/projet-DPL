<?php
session_start();
include_once 'fonction.php';
include_once '../include/fpdf/fpdf.php';

// Démarre le tampon de sortie pour éviter l'erreur FPDF
ob_start(); 

// Récupérer le statut (annuel, mensuel, hebdomadaire)
$statut = $_GET['stat'] ?? '';

$nom_mois = [
    1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril",
    5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Août",
    9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre"
];

// Initialiser le PDF
$pdf = new FPDF();
$pdf->AddPage();

// En-tête du document
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 102, 204);
$pdf->Cell(0, 10, 'DPL (Direction Promotion de Loisir)', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, utf8_decode('Rapport ' . ucfirst($statut)), 0, 1, 'C');

$pdf->Ln(10);

// ----- TRAITEMENT ANNUEL -----
if ($statut === 'annuel') {
    if (!isset($_POST['annee'])) {
        die('Année non fournie.');
    }
    $annee = $_POST['annee'];
    $activite = get_activite_on_annee($annee);

    if (empty($activite)) {
        $_SESSION['message']['text'] = "Pas d'activité pour cette année.";
        $_SESSION['message']['type'] = "danger";
        header('Location: ../vue/imprime_activite.php');
        exit;
    }

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0);
    $pdf->Cell(0, 10, utf8_decode('Année ' . $annee), 0, 1, 'C');

} elseif ($statut === 'mensuel') {
    if (!isset($_POST['mois'])) {
        die('Mois non fourni.');
    }
    list($year, $month) = explode('-', $_POST['mois']);
    $month = (int)$month; // Assurez-vous que $month est un entier
    $activite = get_activite_mensuel($year, $month);

    if (empty($activite)) {
        $_SESSION['message']['text'] = "Pas d'activité pour ce mois.";
        $_SESSION['message']['type'] = "danger";
        header('Location: ../vue/imprime_activite.php');
        exit;
    }

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0);
    $pdf->Cell(0, 10, utf8_decode('Mois de ' . $nom_mois[$month]), 0, 1, 'C');

} elseif ($statut === 'hebdomadaire') {
    if (!isset($_POST['date'])) {
        die('Date non fournie.');
    }
    $date = $_POST['date'];
    $activite = get_activite_hebdomadaire($date);

    if (empty($activite)) {
        $_SESSION['message']['text'] = "Pas d'activité pour cette semaine.";
        $_SESSION['message']['type'] = "danger";
        header('Location: ../vue/imprime_activite.php');
        exit;
    }

    $date_lundi = lundi_de_semaine($date);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0);
    $pdf->Cell(0, 10, utf8_decode('Semaine du Lundi ' . $date_lundi['jour'] . ' ' . $nom_mois[$date_lundi['mois']] . ' ' . $date_lundi['annee']), 0, 1, 'C');

} else {
    die('Statut invalide.');
}

// En-tête du tableau
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0, 102, 204);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(50, 10, utf8_decode('Déscription'), 0, 0, 'C', true);
$pdf->Cell(40, 10, utf8_decode('Responsable'), 0, 0, 'C', true);
$pdf->Cell(40, 10, utf8_decode('Date Début'), 0, 0, 'C', true);
$pdf->Cell(40, 10, 'Date Fin', 0, 0, 'C', true);
$pdf->Cell(20, 10, 'Statut', 0, 1, 'C', true);

// Données du tableau
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0);
$i = 0;
foreach ($activite as $row) {
    $pdf->SetFillColor(($i % 2 == 0) ? 255 : 240);
    $pdf->Cell(50, 10, utf8_decode($row['description']), 0, 0, 'L', true);
    $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 0, 0, 'L', true);
    $pdf->Cell(40, 10, transformDateFormat($row['date_d']), 0, 0, 'C', true);
    $pdf->Cell(40, 10, transformDateFormat($row['date_f']), 0, 0, 'C', true);
    $status = get_statut($row['date_d'], $row['date_f'], $row['expired']);
    $pdf->Cell(20, 10, utf8_decode($status), 0, 1, 'C', true);
    $i++;
}

// Sortie du fichier PDF
ob_end_clean(); // Vider le tampon de sortie pour éviter tout conflit
$pdf->Output('I', 'rapport_activite.pdf'); // Affiche le PDF dans le navigateur
