<?php
include_once 'fonction.php';
include_once '../include/fpdf/fpdf.php';
// Récupérer l'année sélectionnée
$statut = $_GET['stat'];
$nom_mois = [
      1 => "Janvier",
      2 => "Février",
      3 => "Mars",
      4 => "Avril",
      5 => "Mai",
      6 => "Juin",
      7 => "Juillet",
      8 => "Août",
      9 => "Septembre",
      10 => "Octobre",
      11 => "Novembre",
      12 => "Décembre"
  ];
// Create PDF document
$pdf = new FPDF();
$pdf->AddPage();
 if($statut == 'annuel'){
       $annee = $_POST['annee'];
       
       // var_dump($_POST);
       
       // requete activite anuel
       $activite = get_activite_on_annee($annee);
       
       // var_dump($activite);
       if($activite == []){
             $pdf->SetFont('Arial', 'B', 12);
             $pdf->Cell(0, 10, 'DPL(Direction Promotion de Loisir)', 0, 1, 'L'); // Centré
             $pdf->Cell(0, 10, 'Rapport Annuel '.$annee, 0, 1, 'C'); // Centré
             $pdf->Cell(0, 10, date('d/m/Y'), 0, 1, 'R'); // Aligné à droite
             $pdf->SetFont('Arial', '', 12);
             $pdf->Cell(0, 10, 'Il n\'y a pas d\'activit stocker dans la base', 0, 1, 'C'); // Aligné à droite
       
       }else{
             
             // Définition de la police
             $pdf->SetFont('Arial', 'B', 16);
             // Ajout de l'en-tête
             $pdf->Cell(0, 10, 'DPL(Direction Promotion de Loisir)', 0, 1, 'L'); // Centré
             $pdf->Cell(0, 10, 'Rapport Annuel '.$annee, 0, 1, 'C'); // Centré
             $pdf->SetFont('Arial', '', 12);
             $pdf->Cell(0, 10, date('d').' '.$nom_mois[date('m')].' '.date('Y'), 0, 1, 'R'); // Aligné à droite
             // Set font for table header
             $pdf->SetFont('Arial', 'B', 12);
             
             // Table header
             $header = ['ID', 'Déscription', 'Résponsable', 'Date Début', 'Date Fin'];
             $pdf->Cell(20, 10, utf8_decode($header[0]), 1);
             $pdf->Cell(40, 10, utf8_decode($header[1]), 1);
             $pdf->Cell(40, 10, utf8_decode($header[2]), 1);
             $pdf->Cell(40, 10, utf8_decode($header[3]), 1);
             $pdf->Cell(40, 10, utf8_decode($header[4]), 1);
             $pdf->Ln();

             // Boucle pour ajouter les données des activités
             $pdf->SetFont('Arial', '', 12); // Police standard pour les données
             foreach ($activite as $row) {
                 $pdf->Cell(20, 10, $row['id_a'], 1); // ID de l'activité
                 $pdf->Cell(40, 10, utf8_decode($row['description']), 1); // Description
                 $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 1); // Responsable
                 $pdf->Cell(40, 10, utf8_decode($row['date_d']), 1); // Date début
                 $pdf->Cell(40, 10, utf8_decode($row['date_f']), 1); // Date fin
                 $pdf->Ln(); // Saut de ligne pour la prochaine entrée
             }
            }
      }elseif($statut == 'mensuel'){
            $annee = $_POST['annee'];
                  
            // Définition de la police
            $pdf->SetFont('Arial', 'B', 16);
            // Ajout de l'en-tête
            $pdf->Cell(0, 10, 'DPL(Direction Promotion de Loisir)', 0, 1, 'L'); // a gauche
            $pdf->Cell(0, 10, utf8_decode('Rapport mensuel de l\'année '.$annee), 0, 1, 'C'); // Centré
            $pdf->SetFont('Arial', '', 12);
            
            $pdf->Cell(0, 10, date('d').' '.$nom_mois[date('m')].' '.date('Y'), 0, 1, 'R'); // Aligné à droite    
            // var_dump($_POST);
            for ($mois = 1; $mois <= 12; $mois++) {
                  $activite = get_activite_mensuel($annee, $mois);            
                  if (!empty($activite)) {
                        $pdf->SetFont('Arial', 'B', 12); // Police standard pour les données
                        $pdf->Cell(0, 10, utf8_decode("Activité pour le mois de " . $nom_mois[$mois]), 0, 1, 'L'); // a gauche

                        $pdf->SetFont('Arial', '', 12);
                        // Table header
                        $header = ['ID', 'Déscription', 'Résponsable', 'Date Début', 'Date Fin'];
                        $pdf->Cell(20, 10, utf8_decode($header[0]), 1);
                        $pdf->Cell(40, 10, utf8_decode($header[1]), 1);
                        $pdf->Cell(40, 10, utf8_decode($header[2]), 1);
                        $pdf->Cell(40, 10, utf8_decode($header[3]), 1);
                        $pdf->Cell(40, 10, utf8_decode($header[4]), 1);
                        $pdf->Ln();

                        foreach ($activite as $row) {
                              $pdf->SetFont('Arial', '', 12); // Police standard pour les données
                              $pdf->Cell(20, 10, $row['id_a'], 1); // ID de l'activité
                              $pdf->Cell(40, 10, utf8_decode($row['description']), 1); // Description
                              $pdf->Cell(40, 10, utf8_decode($row['nom_p']), 1); // Responsable
                              $pdf->Cell(40, 10, utf8_decode($row['date_d']), 1); // Date début
                              $pdf->Cell(40, 10, utf8_decode($row['date_f']), 1); // Date fin
                              $pdf->Ln(); // Saut de ligne pour la prochaine entrée
                        }
                        $pdf->Ln();
                  }
        }
 }

// Sortie du PDF
// $pdf->Output('D', 'Activites_Annee_' . $annee . '.pdf');
$pdf->Output();
