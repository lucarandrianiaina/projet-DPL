<?php
include_once 'fonction.php';

// extraction des donnees
$id = $_POST['id_a'];
$date_d = $_POST['date_d'];
$date_f = $_POST['date_f'];
$id_resp = $_POST['id_resp'];
$description = $_POST['description'];
// verification de permission
if(has_permission($_SESSION['utilisateur'], 'edit_post')){
      if(isset($_POST['ajout'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  if(!empty($date_d) && !empty($date_f) && !empty($description)){
                        if( strtotime($date_f)<strtotime(date('Y-m-d')) || strtotime($date_f)<strtotime($date_d)){
                              $_SESSION['message']['text'] = "veuiller bien verifier le date";
                              $_SESSION['message']['type'] = "danger";
                        }else{
                              
                              $sql = "UPDATE activite SET description =  ?, date_d = ?, date_f = ? WHERE id_a = ?";
                              $req = $connexion->prepare($sql);
                        
                              $req->execute(array($description, $date_d, $date_f, $id));   
                              if ( $req->rowCount()!=0) {
                                    $_SESSION['message']['text'] = "Modification réussit";
                                    $_SESSION['message']['type'] = "success";
                                }else {
                                    $_SESSION['message']['text'] = "Modification non réussit";
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

header("Location: ../vue/activite.php");