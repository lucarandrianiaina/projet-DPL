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
        $sql = "SELECT personnel.*, login.id_l 
FROM personnel 
INNER JOIN login ON login.id_l = personnel.id_login;
";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}


function get_service($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT service FROM personnel WHERE id_p=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM service";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}
function get_personnel_to_user($id_user){
    $sql = "SELECT p.id_p
    FROM personnel p
    JOIN login l ON p.id_login = l.id_l
    WHERE l.id_l = ?;
    ";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id_user));

        return $req->fetch(PDO::FETCH_ASSOC);
}



function get_tache_en_cours($id_user=null){
    if(empty($id_user)){
        $sql = "SELECT 
        id_a, activite.description, 
            DATE_FORMAT(activite.date_d, '%d %b %Y') AS date_d, 
            DATE_FORMAT(activite.date_f, '%d %b %Y') AS date_f, 
            personnel.nom_p, 
            personnel.mail
        FROM 
            activite
        INNER JOIN 
            personnel ON personnel.id_p = activite.id_resp
        WHERE 
            activite.date_d <= CURDATE() 
            AND activite.date_f >= CURDATE()
        ORDER BY 
            activite.date_f;";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute();
    
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }else{
        if(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'delete_post') && has_permission($id_user, 'view_post')){
            $expired = false;
            $sql = "SELECT 
            id_a, activite.description, 
                DATE_FORMAT(activite.date_d, '%d %b %Y') AS date_d, 
                DATE_FORMAT(activite.date_f, '%d %b %Y') AS date_f, 
                personnel.nom_p, 
                personnel.mail
            FROM 
                activite
            INNER JOIN 
                personnel ON personnel.id_p = activite.id_resp
            WHERE 
                activite.date_d <= CURDATE() 
                AND activite.date_f >= CURDATE() 
                AND expired = ?
            ORDER BY 
                activite.date_f;";
        
            $req = $GLOBALS['connexion']->prepare($sql);
        
            $req->execute(array($expired));
        
            return $req->fetchAll();
        }elseif(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'view_post')){
            $expired = false;
            $personnel = get_personnel_to_user($id_user);
            $service = get_service($personnel['id_p']);
            $sql = "SELECT 
            id_a, activite.description, 
                DATE_FORMAT(activite.date_d, '%d %b %Y') AS date_d, 
                DATE_FORMAT(activite.date_f, '%d %b %Y') AS date_f, 
                personnel.nom_p, 
                personnel.mail
            FROM 
                activite
            INNER JOIN 
                personnel ON personnel.id_p = activite.id_resp
            WHERE 
                activite.date_d <= CURDATE() 
                AND activite.date_f >= CURDATE() 
                AND expired = ? AND personnel.service = ?
            ORDER BY 
                activite.date_f;";
        
            $req = $GLOBALS['connexion']->prepare($sql);
        
            $req->execute(array($expired, $service['service']));
        
            return $req->fetchAll();
        }elseif(has_permission($id_user, 'view_post')){
            $expired = false;
            $personnel = get_personnel_to_user($id_user);
            $sql = "SELECT 
            id_a, activite.description, 
                DATE_FORMAT(activite.date_d, '%d %b %Y') AS date_d, 
                DATE_FORMAT(activite.date_f, '%d %b %Y') AS date_f, 
                personnel.nom_p, 
                personnel.mail
            FROM 
                activite
            INNER JOIN 
                personnel ON personnel.id_p = activite.id_resp
            WHERE 
                activite.date_d <= CURDATE() 
                AND activite.date_f >= CURDATE() 
                AND expired = ? AND personnel.id_p = ?
            ORDER BY 
                activite.date_f;";
        
            $req = $GLOBALS['connexion']->prepare($sql);
        
            $req->execute(array($expired, $personnel['id_p']));
        
            return $req->fetchAll();
        }
    }
}

function get_tache_a_faire($id_user){
    if(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'delete_post') && has_permission($id_user, 'view_post')){
        $expired = false;
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite
        INNER JOIN personnel ON personnel.id_p = activite.id_resp
        WHERE activite.date_d > CURDATE() AND expired = ? ORDER BY activite.date_d ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired));
    
        return $req->fetchAll();
    }elseif(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'view_post')){
        $expired = false;
        $personnel = get_personnel_to_user($id_user);
        $service = get_service($personnel['id_p']);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite
        INNER JOIN personnel ON personnel.id_p = activite.id_resp
        WHERE activite.date_d > CURDATE() AND expired = ? AND personnel.service = ? ORDER BY activite.date_d ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $service['service']));
    
        return $req->fetchAll();

    }elseif(has_permission($id_user, 'view_post')){
        $expired = false;
        $personnel = get_personnel_to_user($id_user);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite
        INNER JOIN personnel ON personnel.id_p = activite.id_resp
        WHERE activite.date_d > CURDATE() AND expired = ? AND personnel.id_p = ? ORDER BY activite.date_d ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $personnel['id_p']));
    
        return $req->fetchAll();

    }
}

function get_tache_fini($id_user){
    if(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'delete_post') && has_permission($id_user, 'view_post')){
        $expired = false;
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired));
    
        return $req->fetchAll();
    }elseif(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'view_post')){
        $expired = false;
        $personnel = get_personnel_to_user($id_user);
        $service = get_service($personnel['id_p']);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? AND personnel.service = ?  ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $service['service']));
    
        return $req->fetchAll();

    }elseif(has_permission($id_user, 'view_post')){
        $expired = false;
        $personnel = get_personnel_to_user($id_user);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? AND personnel.id_p = ?  ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $personnel['id_p']));
    
        return $req->fetchAll();

    }
}
function get_tache_expired($id_user){
    if(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'delete_post') && has_permission($id_user, 'view_post')){
        $expired = true;
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired));
    
        return $req->fetchAll();
    }elseif(has_permission($id_user, 'create_post') && has_permission($id_user, 'edit_post') && has_permission($id_user, 'view_post')){
        $expired = true;
        $personnel = get_personnel_to_user($id_user);
        $service = get_service($personnel['id_p']);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? AND personnel.service = ? ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $service['service']));
    
        return $req->fetchAll();

    }elseif(has_permission($id_user, 'view_post')){
        $expired = true;
        $personnel = get_personnel_to_user($id_user);
        $sql = "SELECT id_a, DATE_FORMAT(activite.date_d,'%d %b %Y') AS date_d, DATE_FORMAT(activite.date_f,'%d %b %Y') AS date_f, personnel.nom_p, activite.description FROM activite 
        INNER JOIN personnel ON personnel.id_p = activite.id_resp 
        WHERE activite.date_f < CURDATE() AND expired = ? AND personnel.id_p = ? ORDER BY activite.date_f DESC ";
    
        $req = $GLOBALS['connexion']->prepare($sql);
    
        $req->execute(array($expired, $personnel['id_p']));
    
        return $req->fetchAll();

    }
}

function get_activite($id = null){
    if (!empty($id)) {
        $sql = "SELECT activite.id_a,activite.description,activite.date_d, activite.date_f,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE id_a=?";
  
        $req = $GLOBALS['connexion']->prepare($sql);
  
        $req->execute(array($id));
  
        return $req->fetch(PDO::FETCH_ASSOC);
      } else {
          $sql = "SELECT activite.id_a,activite.description,activite.date_d, activite.date_f,personnel.nom_p, expired FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute();
  
          return $req->fetchAll();
    }
}

function get_activite_on_annee($annee){
    $sql = "SELECT activite.*,personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp WHERE YEAR(date_d) = ? ORDER BY id_a";
  
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
    activite.date_f,expired
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

function get_activite_ebdomadaire($date) {
    // Calculer la date du lundi de la semaine de la date donnée
    $date_lundi = date('Y-m-d', strtotime($date . ' -' . (date('w', strtotime($date))) . ' days'));

    // Calculer la date du dimanche de la semaine de la date donnée
    $date_dimanche = date('Y-m-d', strtotime($date_lundi . ' + 6 days'));

    // Requête SQL avec la plage de dates (lundi à dimanche)
    $sql = "SELECT id_a, description,personnel.nom_p, date_d, date_f, expired
            FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp
            WHERE date_d >= :date_lundi
            AND date_f <= :date_dimanche";

    // Préparation de la requête
    $req = $GLOBALS['connexion']->prepare($sql);

    // Exécution de la requête avec les paramètres calculés pour lundi et dimanche
    $req->execute(array(':date_lundi' => $date_lundi, ':date_dimanche' => $date_dimanche));

    // Retourner toutes les activités trouvées
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
          $sql = "SELECT id_l, nom_utilisateur, password, personnel.mail FROM login  INNER JOIN personnel ON personnel.id_login = login.id_l WHERE id_l = ?";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute(array($id));
  
          return $req->fetch(PDO::FETCH_ASSOC);
      }else{
        $sql = "SELECT id_l, nom_utilisateur, role_utilisateur.id_role, role.nom_r FROM login  INNER JOIN role_utilisateur ON role_utilisateur.id_utilisateur = login.id_l INNER JOIN role ON role.id_r = role_utilisateur.id_role";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute();
  
          return $req->fetchAll();
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


function transformDateFormat($date) {
    // Créer un objet DateTime à partir de la date d'entrée
    $dateTime = new DateTime($date);

    // Retourner la date dans le format souhaité (jour/mois/année)
    return $dateTime->format('d/m/Y');
}

function lundi_de_semaine($date) {
    // Créer un objet DateTime à partir de la date donnée
    $dateTime = new DateTime($date);
    
    // Récupérer le jour de la semaine (0 = dimanche, 1 = lundi, ..., 6 = samedi)
    $jourSemaine = $dateTime->format('N');  // 1 pour lundi, 7 pour dimanche
    
    // Calculer l'écart par rapport au lundi
    $dateTime->modify('-' . ($jourSemaine - 1) . ' days');
    
    // Retourner la date du lundi
    return $date =['jour'=>$dateTime->format('d'), 'mois'=>$dateTime->format('m'), 'annee'=>$dateTime->format('Y')];
}


// Fonction pour obtenir le statut d'une activité
function get_statut($date_d, $date_f, $expired) {
    $current_date = new DateTime(); // Date actuelle
    $start_date = new DateTime($date_d); // Date de début
    $end_date = new DateTime($date_f); // Date de fin
    
    // Si l'activité est expirée
    if ($expired) {
        return 'Expiré';
    }
    
    // Si l'activité est à venir (avant la date de début)
    if ($current_date < $start_date) {
        return 'À réaliser';
    }
    
    // Si l'activité est en cours (entre la date de début et de fin)
    if ($current_date >= $start_date && $current_date <= $end_date) {
        return 'En cours';
    }
    
    // Si l'activité est terminée (après la date de fin)
    if ($current_date > $end_date) {
        return 'Terminé';
    }
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
            $mail->setFrom('dpl@gmail.com', 'notification DPL');
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