<?php
include 'connexion.php';
$nom = $_POST['nom_p'];
if(isset($_POST['ajout'])){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($nom)){
                  $sql = "INSERT INTO personnel(nom_p)VALUES(?)";
                  $req = $connexion->prepare($sql);
    
                  $req->execute(array($nom));
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