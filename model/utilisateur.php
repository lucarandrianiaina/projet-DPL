<?php
include_once 'connexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Traitement du formulaire
      $personnel = $_POST['personnel'] ?? '';
      $role = $_POST['optradio'] ?? '';
      if(!empty($personnel) && !empty($role) ){
            $sql = "UPDATE role_utilisateur SET id_role = ? WHERE id_utilisateur = ?";
            $req = $connexion->prepare($sql);
            $req->execute(array($role,$personnel));
            if ( $req->rowCount()!=0) {
                  $_SESSION['message']['text'] = "Modification réussit";
                  $_SESSION['message']['type'] = "success";
              }else {
                  $_SESSION['message']['text'] = "Modification non réussit";
                  $_SESSION['message']['type'] = "danger";
              }
        }else {
            $_SESSION['message']['text'] ="veuillez remplire tous les champs";
            $_SESSION['message']['type'] = "danger";
      }  
}

header("Location: ../vue/utilisateur.php");
      
  ?>