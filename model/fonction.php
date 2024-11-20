<?php
include_once 'connexion.php';

function get_personnel($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM personnel WHERE id_p=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM personnel";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}


function get_service($id = null)
{
    if (!empty($id)) {
      //   $sql = "SELECT * FROM personnel WHERE id_p=?";

      //   $req = $GLOBALS['connexion']->prepare($sql);

      //   $req->execute(array($id));

      //   return $req->fetch();
    } else {
        $sql = "SELECT * FROM service";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function get_tache_en_cours(){
    $sql = "SELECT activite.description, activite.date_d, activite.date_f, personnel.nom_p  FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d <= CURDATE() AND activite.date_f >= CURDATE() ORDER BY activite.date_f";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_a_faire(){
    $sql = "SELECT activite.date_d, activite.date_f, personnel.nom_p, activite.description FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d > CURDATE() ORDER BY activite.date_d ";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_fini(){
    $sql = "SELECT activite.date_d, activite.date_f, personnel.nom_p, activite.description FROM activite 
    INNER JOIN personnel ON personnel.id_p = activite.id_resp 
    WHERE activite.date_f < CURDATE() ORDER BY activite.date_f DESC ";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_activite($id = null){
    if (!empty($id)) {
        $sql = "SELECT activite.*,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE id_a=?";
  
        $req = $GLOBALS['connexion']->prepare($sql);
  
        $req->execute(array($id));
  
        return $req->fetch(PDO::FETCH_ASSOC);
      } else {
          $sql = "SELECT activite.*, personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp ORDER BY id_a";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute();
  
          return $req->fetchAll();
    }
}

function get_activite_on_annee($annee){
    $sql = "SELECT activite.*,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE YEAR(date_d) = ?";
  
    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array($annee));

    return $req->fetchAll();
}

function get_activite_mensuel($annee, $mois){
    $sql = "SELECT 
    activite.id_a, 
    activite.description, 
    personnel.nom_p,
    activite.date_d,
    activite.date_f
FROM 
    activite
INNER JOIN personnel ON personnel.id_p = activite.id_resp
WHERE 
    YEAR(activite.date_d) = ?
    AND MONTH(activite.date_d) =?";
  
    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array($annee , $mois));

    return $req->fetchAll();
}
function recherche_activite($description){
        $sql = "SELECT activite.*, personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE activite.description = ?";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute(array($description));
  
          return $req->fetchAll();
}

function recherche_deux_date($date_d, $date_f){
    $sql = "SELECT activite.*, personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE date_d BETWEEN ? AND ?";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute(array($date_d, $date_f));
  
          return $req->fetchAll();
}

function get_last_login(){
    $sql = "SELECT id_l FROM login ORDER BY id_l DESC LIMIT 1";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC);
}

function get_login_connexion($nom_u){
    $sql = "SELECT * FROM login WHERE nom_utilisateur = ?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array($nom_u));

    return $req->fetch(PDO::FETCH_ASSOC);
}



// Fonction pour récupérer les permissions d'un utilisateur
function get_user_permissions($user_id) {
    $sql = "SELECT permission.nom_p
        FROM permission
        JOIN role_permission ON permission.id_p = role_permission.permission_id
        JOIN role_utilisateur ON role_permission.role_id = role_utilisateur.id_role
        WHERE role_utilisateur.id_utilisateur = ?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array($user_id));

    return $req->fetchAll(PDO::FETCH_COLUMN);

}


// Fonction pour vérifier si l'utilisateur a une permission spécifique
function has_permission($user_id, $permission) {
    $permissions = get_user_permissions($user_id);
    return in_array($permission, $permissions);
}


function get_utilisateur($id=null){
    if (!empty($id)) {
          $sql = "SELECT nom_utilisateur FROM login WHERE id_l = ?";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute(array($id));
  
          return $req->fetch(PDO::FETCH_ASSOC);
      }
}

// Fonction pour générer un login unique
function genererLoginParDefaut($nom) {
    global $connexion;
    $login = strtolower($nom);
    $loginUnique = $login;
    $i = 1;

    // Vérifier si le login est unique
    while (!verifierLoginUnique($loginUnique)) {
        $loginUnique = $login . $i;
        $i++;
    }

    return $loginUnique;
}

function verifierLoginUnique($login) {
    global $connexion;
    $sql = "SELECT COUNT(*) FROM login WHERE nom_utilisateur = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$login]);
    return $stmt->fetchColumn() == 0;
}
function genererMotDePasse() {
      $password = password_hash('default123',PASSWORD_DEFAULT);
      return $password; // Mot de passe fixe pour tous les nouveaux utilisateurs
  }
  

  function get_personnel_on_service($id_sevice){
    $sql = "SELECT * FROM personnel WHERE service = ?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id_sevice));

        return $req->fetchAll();
  }

  function send_mail($destinataire){
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->Port = 587;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dplsendnotif@gmail.com';                     //SMTP username
            $mail->Password   = '20LOISIR2024';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

            //Recipients
            $mail->setFrom('dpl@gmail.com', 'Mailer');
            $mail->addAddress($destinataire);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            return $mail->send();
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

  }