<?php
include_once 'fonction.php';
$nom_u = $_POST['nom_u'];
$mdp = $_POST['mdp'];

$user = get_utilisateur($_SESSION['utilisateur']);

// var_dump($user);

if(!empty($nom_u) && !empty($mdp)){
      if($utilisateur && password_verify($mdp,$user['password'])) {
            // reque update
            $sql = "UPDATE login SET nom_utilisateur = ? WHERE id_l = ?";
            $req = $connexion->prepare($sql);
                        
            $req->execute(array($nom_u, $user['id_l'])); 
            if ( $req->rowCount()!=0) {
                  $_SESSION['message']['text'] = "Modification réussit";
                  $_SESSION['message']['type'] = "success";
              }else {
                  $_SESSION['message']['text'] = "Modification non réussit";
                  $_SESSION['message']['type'] = "danger";
              }
      }else{
            $_SESSION['message']['text'] = "Mot de passe incorecte";
            $_SESSION['message']['type'] = "danger";
      }
}else{
      //remplire champ
      $_SESSION['message']['text'] = "Veillez remplire tous les champs";
      $_SESSION['message']['type'] = "danger";
}
header("Location: ../vue/profil.php");