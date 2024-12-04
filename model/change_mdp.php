<?php
include_once 'fonction.php';
$mdp = $_POST['mdp'];
$n_mdp = $_POST['n_mdp'];
$conf_mdp = $_POST['conf_mdp'];

$user = get_utilisateur($_SESSION['utilisateur']);

// var_dump($user);

if(!empty($mdp) && !empty($n_mdp) && !empty($conf_mdp)){
      if($utilisateur && password_verify($mdp,$user['password'])) {
            if($n_mdp == $conf_mdp){
                  $mdp_hash = password_hash($n_mdp, PASSWORD_DEFAULT);
                  // reque update
                  $sql = "UPDATE login SET password = ? WHERE id_l = ?";
                  $req = $connexion->prepare($sql);
                              
                  $req->execute(array($mdp_hash, $user['id_l'])); 
                  if ( $req->rowCount()!=0) {
                        $_SESSION['message']['text'] = "Modification réussit";
                        $_SESSION['message']['type'] = "success";
                    }else {
                        $_SESSION['message']['text'] = "Modification non réussit";
                        $_SESSION['message']['type'] = "danger";
                    }
            }else{
                  $_SESSION['message']['text'] = "confirmé bien votre nouveau mot de passe";
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