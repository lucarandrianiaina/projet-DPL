<?php
session_start();
include_once 'connexion.php';
$id_a = $_POST['id_a'];
$valide = 1;
// Assurez-vous que la page a été appelée avec une méthode POST et qu'un fichier a été téléchargé.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && !empty($id_a)) {
    // Dossier de destination pour les fichiers téléchargés
    $targetDir = "../uploads/"; // Utiliser le dossier uploads situé dans le répertoire parent
    $targetFile = $targetDir . basename($_FILES['file']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifier si le fichier est un PDF (ou tout autre type de fichier valide)
    if ($fileType != "pdf") {
        $_SESSION['message']['text'] = "Désolé, seuls les fichiers PDF sont autorisés.";
        $_SESSION['message']['type'] = "danger";
    }

    // Vérifier si le fichier existe déjà
    if (file_exists($targetFile)) {
        $_SESSION['message']['text'] = "Désolé, ce fichier existe déjà.";
        $_SESSION['message']['type'] = "danger";
    }

    // Vérifier la taille du fichier (par exemple, ne pas dépasser 10 Mo)
    if ($_FILES['file']['size'] > 10485760) { // Limite de 10 Mo
        $_SESSION['message']['text'] = "Désolé, votre fichier est trop grand.";
        $_SESSION['message']['type'] = "danger";
    }

    // Tenter de déplacer le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // requete uptate
        $sql = "UPDATE activite SET valide =  ? WHERE id_a = ?";
        $req = $connexion->prepare($sql);
        
        $req->execute(array($valide, $id_a));   
        if ( $req->rowCount()!=0) {
            $_SESSION['message']['text'] = "validation réussit et Le fichier " . htmlspecialchars(basename($_FILES['file']['name'])) . " a été téléchargé avec succès.";
            $_SESSION['message']['type'] = "success";
        }else {
            $_SESSION['message']['text'] = "validation non réussit";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $_SESSION['message']['text'] = "Désolé, une erreur est survenue lors du téléchargement du fichier.";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    // requete uptate
    $sql = "UPDATE activite SET valide =  ? WHERE id_a = ?";
    $req = $connexion->prepare($sql);
    
    $req->execute(array($valide, $id_a));   
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "validation réussit mais Aucun fichier n'a été téléchargé ou la méthode utilisée n'est pas POST.";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "validation non réussit";
        $_SESSION['message']['type'] = "danger";
    }
}

// Redirection vers la page des activités
header("Location: ../vue/valide_activite.php");
?>
