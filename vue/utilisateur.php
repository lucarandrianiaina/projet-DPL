<?php
include_once 'header.php'
?>

<div class="row">
      <div class="col-sm-12 col-lg-4">
            <!-- formulaire -->
            <form action="" method="post">
                  <div class="form-group">
                        <label for="personnel" class="form-label">Qui est le personnel?</label>
                        <select name="personnel" id="personnel" class="form-control">
                              <option value="">1</option>
                        </select>
                  </div>
                  <h6>Cocher les permissions de l'utilisateur</h6>
                  <div class="row border p-2 mx-2">
                        <div class="col-6">
                              <div class="form-check">
                                    <label class="form-check-label" for="ajout">
                                          <input type="checkbox" class="form-check-input" id=ajout" name="ajout" vamodif">Ajout
                                    </label>
                                    </div>
                              <div class="form-check">
                                    <label class="form-check-label" for="modif">
                                          <input type="checkbox" class="form-check-input" id="modif" name="modif" value="M">Modifier
                                    </label>
                              </div>
                        </div>
                        <div class="col-6">
                              <div class="form-check">
                                    <label class="form-check-label" for="suppr">
                                          <input type="checkbox" class="form-check-input" id="suppr" name="suppr" value="S">Supprimer
                                    </label>
                              </div>
                              <div class="form-check">
                                    <label class="form-check-label" for="voir">
                                          <input type="checkbox" class="form-check-input" id="voir" name="voir" value="V">Voir
                                    </label>
                              </div>
                        </div>
                  </div>
                  <input type="submit" class="btn btn-primary  mx-1 my-2 btn-block" value="VALIDER">
            </form>
      </div>
      <div class="col-sm-12 col-lg-8 border ">
            <!-- tableau de données -->
            <?php
                  var_dump($_POST);
            ?>
      </div>
</div>



<?php
include_once 'footer.php'
?>