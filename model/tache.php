<?php
include_once 'fonction.php';
// extracton des donnees
$date_d = $_POST['date_d'];
$date_f = $_POST['date_f'];
$id_resp = $_POST['id_resp'];
$description = $_POST['description'];

// var_dump($_POST);
if(has_permission($_SESSION['utilisateur'], 'create_post')){
      if(isset($_POST['ajout'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  if(!empty($date_d) && !empty($date_f) && !empty($id_resp) && !empty($description)){
                        if(strtotime($date_d)<strtotime(date('Y-m-d')) || strtotime($date_f)<strtotime(date('Y-m-d')) || strtotime($date_f)<strtotime($date_d)){
                              $_SESSION['message']['text'] = "veuiller bien verifier les dates";
                              $_SESSION['message']['type'] = "danger";
                        }else{
                              
                              $sql = "INSERT INTO activite(description,id_resp,date_d,date_f) VALUES(?, ?, ?, ?)";
                              $req = $connexion->prepare($sql);
                        
                              $req->execute(array($description, $id_resp, $date_d, $date_f));   
                              if ( $req->rowCount()!=0) {
                                    $_SESSION['message']['text'] = "Activité est enregitré avec succés";
                                    $_SESSION['message']['type'] = "success";
                                }else {
                                    $_SESSION['message']['text'] = "Enregistrement non réussit";
                                    $_SESSION['message']['type'] = "danger";
                                }
                        }
                  }else {
                        $_SESSION['message']['text'] ="veuillez remplire tous les champs";
                        $_SESSION['message']['type'] = "danger";
                  }   
            }
      }
}else{
      $_SESSION['message']['text'] = "Vous n'avais pas se permissions";
      $_SESSION['message']['type'] = "danger";
  }

header("Location: ../vue/activite.php?act=EC");