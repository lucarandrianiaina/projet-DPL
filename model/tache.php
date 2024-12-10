<?php
include_once 'fonction.php';
// extraction des données
$date_d = $_POST['date_d'];
$date_f = $_POST['date_f'];
$id_resp = $_POST['id_resp'];
$description = $_POST['description'];

// var_dump($_POST);
if (has_permission($_SESSION['utilisateur'], 'create_post')) {
    if (isset($_POST['ajout'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($date_d) && !empty($date_f) && !empty($id_resp) && !empty($description)) {
                // Vérifier que les dates sont valides
                if (strtotime($date_d) < strtotime(date('Y-m-d')) || strtotime($date_f) < strtotime(date('Y-m-d')) || strtotime($date_f) < strtotime($date_d)) {
                    $_SESSION['message']['text'] = "Veuillez bien vérifier les dates.";
                    $_SESSION['message']['type'] = "danger";
                } else {
                    // Vérifier si l'id_resp est déjà pris pour les dates spécifiées
                    $sql_check = "SELECT COUNT(*) FROM activite WHERE id_resp = ? AND (
                                    (date_d BETWEEN ? AND ?) OR
                                    (date_f BETWEEN ? AND ?)
                                   )";
                    $req_check = $connexion->prepare($sql_check);
                    $req_check->execute(array($id_resp, $date_d, $date_f, $date_d, $date_f));

                    $count = $req_check->fetchColumn();
                    
                    // Si l'utilisateur a déjà une activité pour ces dates, ne pas enregistrer
                    if ($count > 0) {
                        $_SESSION['message']['text'] = "Cette personne a déjà une activité dans ces dates. Enregistrement annulé.";
                        $_SESSION['message']['type'] = "danger";
                    } else {
                        // Insérer l'activité
                        $sql = "INSERT INTO activite(description, id_resp, date_d, date_f) VALUES(?, ?, ?, ?)";
                        $req = $connexion->prepare($sql);
                        $req->execute(array($description, $id_resp, $date_d, $date_f));   

                        // Vérifier si l'insertion a réussi
                        if ($req->rowCount() != 0) {
                            $_SESSION['message']['text'] = "L'activité a été enregistrée avec succès.";
                            $_SESSION['message']['type'] = "success";
                        } else {
                            $_SESSION['message']['text'] = "Enregistrement non réussi.";
                            $_SESSION['message']['type'] = "danger";
                        }
                    }
                }
            } else {
                $_SESSION['message']['text'] = "Veuillez remplir tous les champs.";
                $_SESSION['message']['type'] = "danger";
            }
        }
    }
} else {
    $_SESSION['message']['text'] = "Vous n'avez pas cette permission.";
    $_SESSION['message']['type'] = "danger";
}

// Redirection vers la page des activités
header("Location: ../vue/activite.php");
