
<?php
include 'model/connexion.php';
function generer_date_aleatoire($date_debut, $date_fin) {
    // Convertir les dates en timestamps
    $timestamp_debut = strtotime($date_debut);
    $timestamp_fin = strtotime($date_fin);
  
    // Générer un timestamp aléatoire entre les deux
    $timestamp_aleatoire = rand($timestamp_debut, $timestamp_fin);
  
    // Formater la date
    $date_aleatoire = date('Y-m-d', $timestamp_aleatoire);
  
    return $date_aleatoire;
  }
  
  


    for($i=1;$i<=50;$i++){
        
        $description = 'activite_'.$i;
        $id_resp=rand(1, 4);
        $date_d = new DateTime(generer_date_aleatoire('2024-11-01','2024-12-30'));
        // Cloner l'objet pour ne pas modifier l'original
        $date_f = clone $date_d;
        $date_f->modify('+5 days');
        $sql = "INSERT INTO activite(description,id_resp,date_d,date_f) VALUES(?, ?, ?, ?)";
        $req = $connexion->prepare($sql);
                            
        $req->execute(array($description, $id_resp, $date_d->format('Y-m-d'), $date_f->format('Y-m-d')));

        echo $i .'enregistrement';
    }



    <?php
// Informations de connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$dbname = "votre_base_de_donnees"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL

// Créer une nouvelle connexion PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur pour lever des exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
    exit;
}


