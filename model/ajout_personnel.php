<?php
include 'fonction.php';
$nom = $_POST['nom_p'];
$service = $_POST['service'];
$mail = $_POST['mail'];
if(has_permission($_SESSION['utilisateur'], 'create_post')){

    if (isset($_POST['ajout'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($nom) && !empty($mail) && !empty($service)) {
                // Générer un login par défaut
                $login = genererLoginParDefaut($nom);
                $password = genererMotDePasse();
                
                // Insérer le login dans la table `login`
                $sqlLogin = "INSERT INTO login (nom_utilisateur, password) VALUES (?, ?)";
                $reqLogin = $connexion->prepare($sqlLogin);
                $reqLogin->execute(array($login, $password));
                
                // Récupérer l'ID du login nouvellement inséré
                $idLogin = $connexion->lastInsertId();
                
                // Créer le personnel avec l'ID du login
                $sql = "INSERT INTO personnel (nom_p, service,mail, id_login) VALUES (?, ?, ?, ?)";
                $req = $connexion->prepare($sql);
                $req->execute([$nom, $service,$mail, $idLogin]);
    
                //creer sa permission par defaut
                $sql_permission = "INSERT INTO role_utilisateur (id_utilisateur, id_role) VALUES (?, ?)";
                $req_permission = $connexion->prepare($sql_permission);
                $req_permission->execute(array($idLogin, '3'));
    
    
                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Ajout avec succès.<br> Login par défaut : $login <br> Mots de passe : default123";
                    $_SESSION['message']['type'] = "success";
                } else {
                    $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout";
                    $_SESSION['message']['type'] = "danger";
                }
            } else {
                $_SESSION['message']['text'] = "Veuillez remplir tous les champs";
                $_SESSION['message']['type'] = "danger";
            }
        }
    }
}else{
    $_SESSION['message']['text'] = "Vous n'avais pas se permissions";
                    $_SESSION['message']['type'] = "danger";
}

header("Location: ../vue/personnel.php");


?>
