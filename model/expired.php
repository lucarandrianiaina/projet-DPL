<?php
include_once 'fonction.php';

// extraction des donnees
$id = $_GET['id'];
$expired = true;
// verification de permission
if(has_permission($_SESSION['utilisateur'], 'edit_post')){
      
                              
      $sql = "UPDATE activite SET expired = ? WHERE id_a = ?";
      $req = $connexion->prepare($sql);
                        
      $req->execute(array($expired,$id));     
                    
            
}else{
      $_SESSION['message']['text'] = "Vous n'avais pas se permissions";
      $_SESSION['message']['type'] = "danger";
}

header("Location: ../vue/index.php?act=EX");