<?php
include_once 'header.php'
?>

<div class="row">
      <div class="col-sm-12 col-lg-4">
            <!-- formulaire -->
            <form action="../model/ajout_personnel.php" class="form-groupe" method="post">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" id="nom" name="nom_p" class="form-control" placeholder="Entrer le nom">
                  <input type="submit" class="btn btn-primary w-100 my-3" value="Enregistrer" name="ajout">
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
            <table class="table">
                  <thead>
                        <tr>
                              <th scope="col">#</th>
                              <th scope="col">nom</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                              $personnel = get_personnel();
                              if (!empty($personnel) && is_array($personnel)):
                                    foreach ($personnel as $key => $value):
                        ?>
                        <tr>
                              <th scope="row"><?= $value['id_p']?></th>
                              <td><?= $value['nom_p']?></td>
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