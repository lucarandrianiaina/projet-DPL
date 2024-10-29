<?php
include_once 'header.php';
$activite = get_activite();
?>

<form class="row" method="post">
    <!-- Champ de recherche 1 -->
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <label for="description">Description de l'activité</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Entrez une description">
        </div>
    </div>

    <!-- Champ de recherche 2 -->
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <label for="date_d">Date début</label>
            <input type="date" class="form-control" id="date_d" name="date_d">
        </div>
    </div>

    <!-- Champ de recherche 3 -->
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <label for="date_f">Date fin</label>
            <input type="date" class="form-control" id="date_f" name="date_f">
        </div>
    </div>

    <!-- Bouton de recherche -->
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-outline-primary btn-block" name="search"><i class="fas fa-search"></i> Rechercher</button>
        </div>
    </div>
</form>

<table class="table table-hover">
    <thead>
      <tr>
            <th>Description</th>
            <th>Responsable</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Action</th>
      </tr>
    </thead>

    <?php
    // Afficher toutes les activités si aucun critère de recherche n'a été soumis
    if (!isset($_POST['search'])):
        if (!empty($activite) && is_array($activite)):
            foreach ($activite as $value):
    ?>
        <tbody>
          <tr>
                <td><?= $value['description'] ?></td>
                <td><?= $value['nom_p'] ?></td>
                <td><?= $value['date_d'] ?></td>
                <td><?= $value['date_f'] ?></td>
                <td>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-success"><i class="fas fa-pen"></i></a>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                </td>
          </tr>
        </tbody>
    <?php
            endforeach;
        else:
            echo "<tr><td colspan='5' class='text-center'>Aucune activité trouvée.</td></tr>";
        endif;

    // Cas : Recherche par description uniquement
    elseif (!empty($_POST['description']) && empty($_POST['date_d']) && empty($_POST['date_f'])):
        $search = recherche_activite($_POST['description']);
        if (!empty($search) && is_array($search)):
            foreach ($search as $value):
    ?>
        <tbody>
          <tr>
                <td><?= $value['description'] ?></td>
                <td><?= $value['nom_p'] ?></td>
                <td><?= $value['date_d'] ?></td>
                <td><?= $value['date_f'] ?></td>
                <td>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-success"><i class="fas fa-pen"></i></a>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                </td>
          </tr>
        </tbody>
    <?php
            endforeach;
        else:
            echo "<tr><td colspan='5' class='text-center'>Aucun résultat pour cette description.</td></tr>";
        endif;

    // Cas : Recherche entre deux dates
    elseif (empty($_POST['description']) && !empty($_POST['date_d']) && !empty($_POST['date_f'])):
        $search = recherche_deux_date($_POST['date_d'], $_POST['date_f']);
        if (!empty($search) && is_array($search)):
            foreach ($search as $value):
    ?>
        <tbody>
          <tr>
                <td><?= $value['description'] ?></td>
                <td><?= $value['nom_p'] ?></td>
                <td><?= $value['date_d'] ?></td>
                <td><?= $value['date_f'] ?></td>
                <td>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-success"><i class="fas fa-pen"></i></a>
                      <a href="tous_activite.php?id=<?= $value['id_a'] ?>" class="btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                </td>
          </tr>
        </tbody>
    <?php
            endforeach;
        else:
            echo "<tr><td colspan='5' class='text-center'>Aucun résultat pour cette plage de dates.</td></tr>";
        endif;
    endif;
    ?>
</table>

<?php
include_once 'footer.php';
?>
