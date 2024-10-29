<?php
include 'connexion.php';
$description = $_POST['description'];
if(isset($_POST['ajout'])){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($description)){
                  $sql = "INSERT INTO activite(description)VALUES(?)";
                  $req = $connexion->prepare($sql);
    
                  $req->execute(array($description));
                  if ( $req->rowCount()!=0) {
                        $_SESSION['message']['text'] = "ajout avec succès";
                        $_SESSION['message']['type'] = "success";
                    }else {
                        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout";
                        $_SESSION['message']['type'] = "danger";
                    }
            }else{
                  $_SESSION['message']['text'] ="veuillez remplire tous les champs";
                  $_SESSION['message']['type'] = "danger";
            }
      }
}
header("Location: ../vue/personnel.php");