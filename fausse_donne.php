// function generer_date_aleatoire($date_debut, $date_fin) {
//     // Convertir les dates en timestamps
//     $timestamp_debut = strtotime($date_debut);
//     $timestamp_fin = strtotime($date_fin);
  
//     // Générer un timestamp aléatoire entre les deux
//     $timestamp_aleatoire = rand($timestamp_debut, $timestamp_fin);
  
//     // Formater la date
//     $date_aleatoire = date('Y-m-d', $timestamp_aleatoire);
  
//     return $date_aleatoire;
//   }
  
  


//     for($i=1;$i<=50;$i++){
        
//         $description = 'activite_'.$i;
//         $id_resp=rand(2, 7);
//         $date_d = new DateTime(generer_date_aleatoire('2024-11-01','2024-12-30'));
//         // Cloner l'objet pour ne pas modifier l'original
//         $date_f = clone $date_d;
//         $date_f->modify('+5 days');
//         $sql = "INSERT INTO activite(description,id_resp,date_d,date_f) VALUES(?, ?, ?, ?)";
//         $req = $connexion->prepare($sql);
                            
//         $req->execute(array($description, $id_resp, $date_d->format('Y-m-d'), $date_f->format('Y-m-d')));

//         echo $i .'enregistrement';
//     }