<?php
session_start();
include_once 'fonction.php';
$mail =  $_POST['mail'];
// var_dump($personnel);
if(!empty($mail)){
      $_SESSION['key'] = rand(1000, 9999);
      $message = [
            'head'=>'confirmation de changement d\'adresse mail',
            'body'=>'voici une votre cle de confirmation : '.$_SESSION['key'],
            'alt_body'=>'valider votre modification'
      ];
      if(send_mail($mail,$message)){
            $_SESSION['message']['text'] = "Mail envoyer avec succés";
            $_SESSION['message']['type'] = "success";
            $_SESSION['mail'] = $mail;
      }else{
            $_SESSION['message']['text'] = "Echec d'envoie";
            $_SESSION['message']['type'] = "danger";
      }
}else{
      $_SESSION['message']['text'] = "Veillez remplir le champ";
      $_SESSION['message']['type'] = "danger";
}
header("Location: ../vue/change_mail.php");