<?php
include_once 'connexion.php';

function get_personnel($id = null)
{
    if (!empty($id)) {
      //   $sql = "SELECT * FROM personnel WHERE id_p=?";

      //   $req = $GLOBALS['connexion']->prepare($sql);

      //   $req->execute(array($id));

      //   return $req->fetch();
    } else {
        $sql = "SELECT * FROM personnel";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function get_tache_en_cours(){
    $sql = "SELECT activite.description, activite.date_d, activite.date_f, personnel.nom_p  FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d <= CURDATE() AND activite.date_f >= CURDATE() ORDER BY activite.date_f LIMIT 4";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_a_faire(){
    $sql = "SELECT activite.date_d, activite.date_f, personnel.nom_p, activite.description FROM activite
    INNER JOIN personnel ON personnel.id_p = activite.id_resp
    WHERE activite.date_d > CURDATE() ORDER BY activite.date_d LIMIT 4";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_tache_fini(){
    $sql = "SELECT activite.date_d, activite.date_f, personnel.nom_p, activite.description FROM activite 
    INNER JOIN personnel ON personnel.id_p = activite.id_resp 
    WHERE activite.date_f < CURDATE() ORDER BY activite.date_f DESC LIMIT 4";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetchAll();
}

function get_activite($id = null){
    if (!empty($id)) {
        $sql = "SELECT * FROM activite WHERE id_a=?";
  
        $req = $GLOBALS['connexion']->prepare($sql);
  
        $req->execute(array($id));
  
        return $req->fetch();
      } else {
          $sql = "SELECT activite.*, personnel.nom_p FROM activite INNER JOIN personnel ON personnel.id_p = activite.id_resp ORDER BY id_a";
  
          $req = $GLOBALS['connexion']->prepare($sql);
  
          $req->execute();
  
          return $req->fetchAll();
    }
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