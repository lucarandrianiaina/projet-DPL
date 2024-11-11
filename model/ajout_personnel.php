<?php
include 'fonction.php';
$nom = $_POST['nom_p'];
// $patern = '1234';
// $password = password_hash($patern, PASSWORD_DEFAULT);
// $get_id = get_last_login();
// $id_l = $get_id['id_l']+1;
if(isset($_POST['ajout'])){
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($nom)){
                  // // creer un compte pour le personnel enregistrer avec une compte par defaut
                  // $sql_1 = "INSERT INTO login(nom_utilisateur,password)VALUES(?, ?)";
                  // $req_1 = $connexion->prepare($sql_1);
    
                  // $req_1->execute(array($nom, $password));
                  
                  // creer le personnel
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