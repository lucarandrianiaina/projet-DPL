<?php
include_once 'fonction.php';

// extraction des donnees
$id = $_GET['id'];

// verification de permission
if(has_permission($_SESSION['utilisateur'], 'delete_post')){
      $sql = "DELETE FROM activite WHERE id_a = ?";
      $req = $connexion->prepare($sql);
                        
      $req->execute(array($id)); 
      $_SESSION['message']['text'] = "activité supprimer avec succés";
      $_SESSION['message']['type'] = "success";
}else{
      $_SESSION['message']['text'] = "Vous n'avais pas se permissions";
      $_SESSION['message']['type'] = "danger";
}

header("Location: ../vue/activite.php");