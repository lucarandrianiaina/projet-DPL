<?php
$title_head = 'GÉRER LES UTILISATEURS';
include_once 'header.php';
?>

<div class="row">
    <div class="col-sm-12 col-lg-4">
        <!-- Formulaire -->
        <form action="../model/utilisateur.php" method="post">
            <div class="form-group">
                <label for="personnel" class="form-label">Qui est le personnel ?</label>
                <select name="personnel" id="personnel" class="form-control">
                    <!-- Exemple d'options dynamiques, vous devrez remplacer cela par une récupération depuis la base de données -->
                    <option value="">Sélectionner un personnel</option>
                    <?php
                    // Supposons que vous ayez une fonction `get_personnel()` qui récupère les personnels depuis la base de données
                    $personnels = get_personnel(); // Exemple de récupération des personnels
                    if (!empty($personnels)) {
                        foreach ($personnels as $personne) {
                            echo "<option value='{$personne['id_l']}'>{$personne['nom_p']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <h6>Cocher la fonction de l'utilisateur</h6>
            <div class="border p-2 mx-2">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="1"> Administrateur
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="2"> Éditeur
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="3"> Visualiseur
                    </label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mx-1 my-2 btn-block" value="VALIDER">
        </form>
            <?php if (!empty($_SESSION['message']['text'])):?>
                  <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                  <?php
                        unset($_SESSION['message']);
                  ?>
                  </div>
            <?php endif; ?>
    </div>

    <div class="col-sm-12 col-lg-8 border">
        <!-- Tableau des utilisateurs -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Type de compte</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

<?php
include_once 'footer.php';
?>
