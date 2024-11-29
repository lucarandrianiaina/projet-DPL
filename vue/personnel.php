<?php
$title_head = 'PERSONNEL';
include_once 'header.php';

if(has_permission($_SESSION['utilisateur'], 'create_post') && has_permission($_SESSION['utilisateur'], 'edit_post') && has_permission($_SESSION['utilisateur'], 'delete_post') && has_permission($_SESSION['utilisateur'], 'view_post')){
      $personnel = get_personnel();
}else{
      $info_personnel = get_personnel($_SESSION['utilisateur']);
      $personnel = get_personnel_on_service($info_personnel['service']);
}
$service = get_service();

?>

<div class="row">
      <div class="col-sm-12 col-lg-4">
            <!-- formulaire -->
            <form action="../model/ajout_personnel.php" class="form-groupe" method="post">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" id="nom" name="nom_p" class="form-control" placeholder="Entrer le nom">
                  <label for="service" class="form-label">service</label>
                  <select name="service" id="service" class="form-control">
                        <?php
                              if (!empty($service) && is_array($service)):
                                    foreach ($service as $key => $value):
                        ?>
                        <option value="<?= $value['id_s']?>">
                              <?= $value['nom_s']?>
                        </option>
                        <?php
                                    endforeach;
                              endif;
                        ?>
                  </select>
                  <input type="submit" class="btn btn-primary w-100 my-3 <?= has_permission($_SESSION['utilisateur'], 'create_post')== false ? 'disabled' : ''?>" value="Enregistrer" name="ajout">
            </form>
            <?php if (!empty($_SESSION['message']['text'])):?>
            <div>
                  <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                        <?php
                              unset($_SESSION['message']);
                        ?>
                    </div>
            </div>
            <?php endif; ?>
      </div>
      <div class="col-sm-12 col-lg-8 border rounded">
            <!-- tableau de données -->
            <table class="table table-hover">
                  <thead>
                        <tr>
                              <th scope="col">#</th>
                              <th scope="col">nom</th>
                              <th scope="col">mail</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                              if (!empty($personnel) && is_array($personnel)):
                                    foreach ($personnel as $key => $value):
                        ?>
                        <tr>
                              <th scope="row"><?= $value['id_p']?></th>
                              <td><?= $value['nom_p']?></td>
                              <td><?= $value['mail']?></td>
                        </tr>
                        <?php
                                    endforeach;
                              endif;
                        ?>
                  </tbody>
            </table>
      </div>
</div>



<?php
include_once 'footer.php'
?>