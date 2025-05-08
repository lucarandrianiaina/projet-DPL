 <?php
      include_once 'fonction.php';
      $id = $_GET['id_u'];

      if (!empty($id)) {
            $sql = "UPDATE login SET confirme = ? WHERE id_l = ?";
            $req = $connexion->prepare($sql);

            $req->execute(array( 1, $id));
            if ($req->rowCount() != 0) {
                  $_SESSION['message']['text'] = "le personnel est confirmer";
                  $_SESSION['message']['type'] = "success";
            } else {
                  $_SESSION['message']['text'] = "erreur dans le confirmation";
                  $_SESSION['message']['type'] = "danger";
            }
      } else {
            $_SESSION['message']['text'] = "information manquant";
            $_SESSION['message']['type'] = "danger";
      }

header("Location: ../vue/confirme_utilisateur.php");