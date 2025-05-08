<?php
$title_head = 'CONFIRMER LES UTILISATEURS';
include_once 'header.php';
$personnels = get_login_non_confirme();
?>

<?php if (!empty($_SESSION['message']['text'])):?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
            <?php
                  unset($_SESSION['message']);
            ?>
      </div>
<?php endif; ?>

<table class="table table-hover" id="mytable">
      <thead>
            <tr>
                  <th>
                        nom
                  </th>
                  <th>
                        adresse mail
                  </th>
                  <th>
                        service
                  </th>
                  <th>
                        fonction
                  </th>
                  <th>
                        action
                  </th>
            </tr>
      </thead>
      <tbody>
            <?php
                  foreach ($personnels as $value):
            ?>
            <tr>
                  <td>
                        <?=$value['nom_p']?>
                  </td>
                  <td>
                        <?=$value['mail']?>
                  </td>
                  <td>
                        <?=$value['nom_s']?>
                  </td>
                  <td>
                        <?=$value['nom_f']?>
                  </td>
                  <td>
                        <a href="../model/confirme_utilisateur.php?id_u=<?=$value['id_l'];?>" class="btn btn-primary"><i class="fas fa-check"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
            </tr>
            <?php
                  endforeach;
            ?>
      </tbody>
</table>
<?php
include_once 'footer.php';
?>
