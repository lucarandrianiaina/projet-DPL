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
                  <h6>Cocher la fonction de l'utilisateur</h6>
                  <div class="border p-2 mx-2">
                        <div class="form-check">
                              <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="admin">Administrateur
                              </label>
                        </div>
                        <div class="form-check">
                              <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="editor">Editeur
                              </label>
                        </div>
                        <div class="form-check">
                              <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="viewer">Visualiseur
                              </label>
                        </div>
                  </div>
                  <input type="submit" class="btn btn-primary  mx-1 my-2 btn-block" value="VALIDER">
            </form>
      </div>
      <div class="col-sm-12 col-lg-8 border ">
            <!-- tableau de données -->
            
      </div>
</div>



<?php
include_once 'footer.php'
?>