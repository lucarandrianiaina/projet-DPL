<?php
include_once '../model/fonction.php';


// $destinataire = 'test@gmail.com';
// $message=['head'=>'en tete','body'=>'corps' ,'alt_body'=>'pied'];
// send_mail($destinataire, $message);

// envoi mail des activité en cours
$activite = get_tache_en_cours();

// var_dump($activite);
$compte = 0;
foreach($activite as $value){
    //calcul du reste de jours
    $date1 = new DateTime($value['date_d']);
    $date2 = new DateTime($value['date_f']);
    $interval = $date1->diff($date2) ;
    $durre = $interval->format('%a jours'); 
    $reste = intval($durre)/2;

    $date_envoi = moitie_date($value['date_d'] , $value['date_f']);
    $date_jour = date('d-m-y');
    if($date_jour==$date_envoi){
        $compte +=1;
        $destinataire = $value['mail'];
        $message=[
            'head'=>'Notification d\'activité '.$value['description'],
            'body'=>'L\'activité de votre responassabilité est  a la moitié de sa durrée.<br><br>Il vous reste <b>'.$reste.'jours</b>' ,
            'alt_body'=>'Se termine le '.$value['date_f']
        ];
        send_mail($destinataire, $message);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>envoi Mail</title>
</head>
<body>
    <h4>
        <?=$compte==0 ? 'pas de message envoyer' : $compte.' message envoyer'?>
    </h4>
    <?php
    // Définir la locale française
    setlocale(LC_TIME, 'fr_FR');

    // Date à convertir (exemple au format anglais)
    $date_en = '2023-04-05';

    // Convertir en format français
    $date_fr = strftime('%d %M %Y', strtotime($date_en));

    echo $date_fr;
    ?>
</body>
</html>
