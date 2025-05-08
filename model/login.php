<?php
include_once 'fonction.php';
$nom_u = $_POST['nom_u'];
$mdp = $_POST['mdp'];

if(isset($_POST['connexion'])){
      if (!empty($nom_u) && !empty($mdp)) {
            $utilisateur = get_login_connexion($nom_u);
            if($utilisateur['confirme'] == 0){
                  $_SESSION['message']['text'] = "Votre compte n'a pas encor confirmer";
                  $_SESSION['message']['type'] = "danger";
                  header('Location: ../vue/login.php');
            }else{
                  if (!empty($utilisateur) && is_array($utilisateur)){
                        if($utilisateur && password_verify($mdp,$utilisateur['password'])) {
                              $_SESSION['utilisateur'] =$utilisateur['id_l'];
                              header('Location: ../vue/index.php');
                        } else {
                              $_SESSION['message']['text'] = "mots de passe incorrecte";
                              $_SESSION['message']['type'] = "danger";
                              header('Location: ../vue/login.php');
                        }
                  } else {
                        $_SESSION['message']['text'] = "Votre nom d'utilisateur ne se trouve pas dans la base";
                        $_SESSION['message']['type'] = "danger";
                        header('Location: ../vue/login.php');
                  }
            }
      }else{
            $_SESSION['message']['text'] = "veuiller remplire tous les champs";
            $_SESSION['message']['type'] = "danger";
            header('Location: ../vue/login.php');
      }
}
?>