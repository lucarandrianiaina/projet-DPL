<?php
include_once 'connexion.php';
//class utiliser pour phpmailer

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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
    $sql = "SELECT activite.description, DATE_FORMAT(activite.date_d,'%d %M %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %M %Y') AS date_f, personnel.nom_p, personnel.mail  FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d <= CURDATE() AND activite.date_f >= CURDATE() ORDER BY activite.date_f";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_a_faire(){
    $sql = "SELECT DATE_FORMAT(activite.date_d,'%d %M %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %M %Y') AS date_f, personnel.nom_p, activite.description FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d > CURDATE() ORDER BY activite.date_d ";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_fini(){
    $sql = "SELECT DATE_FORMAT(activite.date_d,'%d %M %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %M %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
    INNER JOIN personnel ON personnel.id_p = activite.id_resp 
    WHERE activite.date_f < CURDATE() ORDER BY activite.date_f DESC ";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_activite($id = null){
    if (!empty($id)) {
        $sql = "SELECT activite.id_a,activite.description,DATE_FORMAT(activite.date_d,'%d %M %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %M %Y') AS date_f,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE id_a=?";
  
        $req = $GLOBALS['connexion']->prepare($sql);
  
        $req->execute(array($id));
  
        return $req->fetch(PDO::FETCH_ASSOC);
      } else {
          $sql = "SELECT activite.id_a,activite.description,DATE_FORMAT(activite.date_d,'%d %M %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %M %Y') AS date_f,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp ORDER BY id_a";
  
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


function moitie_date($date_d , $date_f){
    // Création des deux dates
    $date1 = new DateTime($date_d);
    $date2 = new DateTime($date_f);
    // Calcul de la différence entre les deux dates
    $interval = $date1->diff($date2);
    // Récupération du nombre de jours de l'intervalle et division par 2
    $days = ceil($interval->days / 2);
    // Création de la date médiane en ajoutant la moitié des jours à la première date
    $dateMedian = clone $date1;
    $dateMedian->add(new DateInterval("P{$days}D"));
    return $dateMedian->format('d-m-y'); // Affiche la date médiane
}


function to_fr(string $date_en){
    $date_fr = DateTime::createFromFormat('j F Y', $date_en)->format('d/m/Y');
    return $date_fr; // Affichera : 20/12/2024  
}











  function send_mail($destinataire, $message=['head'=>'','body'=>'' ,'alt_body'=>'']){
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    require_once '../include/PHPMailer/src/Exception.php';
    require_once '../include/PHPMailer/src/PHPMailer.php';
    require_once '../include/PHPMailer/src/SMTP.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Charset
    $mail->CharSet = 'UTF-8';
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                      // Définir l'utilisation de SMTP
            $mail->Host = 'localhost';                          // Adresse du serveur SMTP (Mailhog)
            $mail->Port = 1025;                                   // Port SMTP de Mailhog
            $mail->SMTPAuth = false; ;                           //pas d'autentification

            //Recipients
            $mail->setFrom('dpl@gmail.com', 'notification activité');
            $mail->addAddress($destinataire);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $message['head'];
            $mail->Body    = $message['body'];
            $mail->AltBody = $message['alt_body'];

            return $mail->send();
        } catch (Exception) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

  }