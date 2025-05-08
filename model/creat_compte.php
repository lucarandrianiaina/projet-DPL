<?php
// Inclure la connexion à la base de données
include_once '../model/connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Récupérer les données envoyées par le formulaire
      $nom_p = isset($_POST['nom_p']) ? trim($_POST['nom_p']) : '';
      $service = isset($_POST['service']) ? (int)$_POST['service'] : 0;
      $fonction = isset($_POST['fonction']) ? (int)$_POST['fonction'] : 0;
      $mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';
      $nom_u = isset($_POST['nom_u']) ? trim($_POST['nom_u']) : '';
      $mdp = isset($_POST['mdp']) ? trim($_POST['mdp']) : '';

      // Validation des champs
      if (empty($nom_p) || empty($service) || empty($fonction) || empty($mail) || empty($nom_u) || empty($mdp)) {
            $_SESSION['message']['text'] = "Veuillez remplir tous les champs";
            $_SESSION['message']['type'] = "danger";
            header('Location: ../vue/creat_compte.php');
            exit;
      } else {
            // Hachage du mot de passe pour plus de sécurité
            $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
            // Insérer le login dans la table `login`
            $sqlLogin = "INSERT INTO login (nom_utilisateur, password) VALUES (?, ?)";
            $reqLogin = $connexion->prepare($sqlLogin);
            $reqLogin->execute(array($nom_u, $hashed_mdp));

            // Récupérer l'ID du login nouvellement inséré
            $idLogin = $connexion->lastInsertId();

            // Créer le personnel avec l'ID du login
            $sql = "INSERT INTO personnel (nom_p, service,mail, id_login, id_f) VALUES (?, ?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute([$nom_p, $service, $mail, $idLogin, $fonction]);
            //gerer les permissions
            if ($fonction == '1') {
                  //creer sa permission du dirrecteur
                  $sql_permission = "INSERT INTO role_utilisateur (id_utilisateur, id_role) VALUES (?, ?)";
                  $req_permission = $connexion->prepare($sql_permission);
                  $req_permission->execute(array($idLogin, '1'));
            } elseif ($fonction == '2') {
                  //creer sa permission du chef de service
                  $sql_permission = "INSERT INTO role_utilisateur (id_utilisateur, id_role) VALUES (?, ?)";
                  $req_permission = $connexion->prepare($sql_permission);
                  $req_permission->execute(array($idLogin, '2'));
            } elseif ($fonction == '3') {
                  //creer sa permission du personnel
                  $sql_permission = "INSERT INTO role_utilisateur (id_utilisateur, id_role) VALUES (?, ?)";
                  $req_permission = $connexion->prepare($sql_permission);
                  $req_permission->execute(array($idLogin, '3'));
            }
            $_SESSION['message']['text'] = "votre compte a été enregister \n veuillez attendre la confirmation ou appelez votre dirrecteur";
            $_SESSION['message']['type'] = "succes";
            header('Location: ../vue/login.php');
      }
} else {
      // Si la méthode de requête n'est pas POST, rediriger l'utilisateur
      header('Location: ../vue/loging.php');
      exit;
}
