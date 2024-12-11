<?php
session_start();
include_once 'fonction.php';
$personnel = get_personnel_to_user($_SESSION['utilisateur']);
$id_p = $personnel['id_p'];
$utilisateur = get_utilisateur($_SESSION['utilisateur']);
$mdp_utilisateur = $utilisateur['password'];
$key = $_POST['key'];
$mdp = $_POST['mdp'];
$mail = $_SESSION['mail'];
if(!empty($key) && !empty($mdp)){
      if($key == $_SESSION['key']){
            if(password_verify($mdp, $mdp_utilisateur)){
                  $sql = "UPDATE personnel SET mail =  ?";
                  $req = $connexion->prepare($sql);   
                  $req->execute(array($mail));
                  if ( $req->rowCount()!=0) {
                        $_SESSION['message']['text'] = "Modification réussit";
                        $_SESSION['message']['type'] = "success";
                        unset($_SESSION['mail']);
                        unset($_SESSION['key']);
                        header("Location: ../vue/profil.php");
                  }else {
                        $_SESSION['message']['text'] = "Modification non réussit";
                        $_SESSION['message']['type'] = "danger";
                        unset($_SESSION['mail']);
                        unset($_SESSION['key']);
                        header("Location: ../vue/change_mail.php");
                  }
            }else{
                  $_SESSION['message']['text'] = "Mot de passe incorrecte";
                  $_SESSION['message']['type'] = "danger";
                  unset($_SESSION['mail']);
                  unset($_SESSION['key']);
                  header("Location: ../vue/change_mail.php");
            }
      }else{
            $_SESSION['message']['text'] = "Clé incorrecte";
            $_SESSION['message']['type'] = "danger";
            unset($_SESSION['mail']);
            unset($_SESSION['key']);
            header("Location: ../vue/change_mail.php");
      }
}
