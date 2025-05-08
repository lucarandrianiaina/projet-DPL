<?php
$title_head = 'PERSONNEL';
include_once 'header.php';

if (has_permission($_SESSION['utilisateur'], 'create_post') && has_permission($_SESSION['utilisateur'], 'edit_post') && has_permission($_SESSION['utilisateur'], 'delete_post') && has_permission($_SESSION['utilisateur'], 'view_post')) {
      $personnel = get_personnel();
} else {
      $personnel = get_personnel_to_user($_SESSION['utilisateur']);
      $info_personnel = get_personnel($personnel['id_p']);
      $personnel = get_personnel_on_service($info_personnel['service']);
}
$service = get_service();
?>
<?php if (!empty($_SESSION['message']['text'])):?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
            <?php
                  unset($_SESSION['message']);
            ?>
      </div>
<?php endif; ?>
<!-- tableau de données -->
<table class="table table-hover" id="mytable">
    <thead>
        <tr>
            <th scope="col">disponibilité</th>
            <th scope="col">Nom</th>
            <th scope="col">Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($personnel) && is_array($personnel)): ?>
            <?php foreach ($personnel as $key => $value): ?>
                <tr>
                    <td>
                        <a href="#" 
                           class="btn btn-<?= get_disponibilite($value['id_p']) ? 'success' : 'danger' ?>" 
                           data-toggle="modal" 
                           data-target="#myModal<?= $value['id_p'] ?>">
                           <?= get_disponibilite($value['id_p']) ? '✔' : '✖' ?>
                        </a>
                    </td>
                    <td><?= $value['nom_p'] ?></td>
                    <td><?= $value['mail'] ?></td>
                </tr>

                <?php if (get_disponibilite($value['id_p'])): ?>
                    <!-- Modal pour <?= $value['nom_p'] ?> -->
                    <div class="modal fade" id="myModal<?= $value['id_p'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $value['id_p'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel<?= $value['id_p'] ?>">Ajouter une tâche pour <strong><?= $value['nom_p'] ?></strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="../model/tache.php" method="post">
                                        <div class="form-group">
                                            <label for="description<?= $value['id_p'] ?>">Description</label>
                                            <input type="text" class="form-control" id="description<?= $value['id_p'] ?>" name="description" placeholder="Entrer la description de l'activité" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control d-none" id="id_resp<?= $value['id_p'] ?>" name="id_resp" value="<?= $value['id_p'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_d<?= $value['id_p'] ?>">Date début</label>
                                            <input type="date" class="form-control" id="date_d<?= $value['id_p'] ?>" name="date_d" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_f<?= $value['id_p'] ?>">Date fin</label>
                                            <input type="date" class="form-control" id="date_f<?= $value['id_p'] ?>" name="date_f" required>
                                        </div>
                                        <input type="submit" value="AJOUTER" class="btn btn-primary w-100 mt-2" name="ajout">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>






<?php
include_once 'footer.php'
?>