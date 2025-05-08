<?php
session_start();
$title_head ='VALIDE ACTIVITE';
include_once 'header.php'; 
$personnel = get_personnel_to_user($_SESSION['utilisateur']);

$activite = get_activite_non_valide($personnel['id_p']);

?>
<?php if (!empty($_SESSION['message']['text'])):?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
            <?php
                  unset($_SESSION['message']);
            ?>
      </div>
<?php endif; ?>
<form action="../model/valide_activite.php" method="post" enctype="multipart/form-data">
      <div class="form-groupe">
            <label for="id_a" class="form-label">Séléction l'activité à valider</label>
            <select name="id_a" id="id_a" class="form-control">
                  <option value="">-- Séléction une activité --</option>
                  <?php
                        foreach ($activite as $value):
                  ?>
                        <option value="<?=$value['id_a']?>"><?=$value['description']?></option>
                  <?php
                        endforeach;
                  ?>
            </select>
      </div>
      <div class="form-groupe">
            <label for="file" class="form-label">fichier</label>
            <input type="file" name="file" id="file" class="form-control">
      </div>
      <input class="btn btn-primary my-2" type="submit" value="Valider">
</form>

<?php
include_once 'footer.php';
?>