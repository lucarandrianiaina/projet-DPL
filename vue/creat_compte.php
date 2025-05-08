<?php
include_once '../model/fonction.php';
$services = get_service();
$fonctions = get_fonction();
// var_dump($service);
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>créer votre compte</title>
</head>

<body>
      <form action="../model/creat_compte.php" method="post">
            <label for="mon">mon</label>
            <input type="text" id="mon" name="nom_p" placeholder="entrer votre nom">
            <label for="service">service</label>
            <select name="service" id="service">
                  <option value="">entrer le service</option>
                  <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id_s'] ?>"><?= $service['nom_s'] ?></option>
                  <?php endforeach ?>
            </select>
            <select name="fonction" id="fonction">
                  <option value="">entrer le fonction</option>
                  <?php foreach ($fonctions as $fonction): ?>
                        <option value="<?= $fonction['id_f'] ?>"><?= $fonction['nom_f'] ?></option>
                  <?php endforeach ?>
            </select>
            <label for="mail">mail</label>
            <input type="mail" id="mail" name="mail" placeholder="entrer votre mail">
            <hr>
            <label for="mon_u">nom d'utilisateur</label>
            <input type="text" id="mon_u" name="nom_u" placeholder="entrer votre nom d'utilisateur">
            <label for="mdp">mdp</label>
            <input type="password" id="mdp" name="mdp" placeholder="entrer votre mdp">
            <input type="submit" value="creer mon compte">
      </form>
      <?php if (!empty($_SESSION['message']['text'])): ?>
            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
                  <?= $_SESSION['message']['text'] ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); // Supprimer le message après l'affichage 
            ?>
      <?php endif; ?>
</body>

</html>