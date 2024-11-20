<form method="post" action="../model/etat.php?stat=mensuel">
      <div class="form-group">

            <label for="annee" class="form-label">Sélectionnez une année :</label>
            <select name="annee" id="annee" class="form-control">
                <?php
                // Code PHP pour générer dynamiquement les options d'années
                for ($i = intval(date('Y')); $i >= intval(date('Y'))-10; $i--) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
      </div>
    <input type="submit" value="Générer l'état" class="btn btn-primary">
</form>