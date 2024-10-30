<?php
include 'fonction.php';
$nom = $_POST['nom_p'];
$mdp_default = '1234';
$get_id = get_last_login();
$id_l = $get_id['id_l']+1;
if(isset($_POST['ajout'])){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($nom)){
                  // creer un compte pour l'utilisateur enregistrer
                  $sql_1 = "INSERT INTO login(nom_utilisateur,mdp)VALUES(?, ?)";
                  $req_1 = $connexion->prepare($sql_1);
    
                  $req_1->execute(array($nom, $mdp_default));

                  $sql = "INSERT INTO personnel(nom_p, id_login)VALUES(?, ?)";
                  $req = $connexion->prepare($sql);
    
                  $req->execute(array($nom, $id_l));

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