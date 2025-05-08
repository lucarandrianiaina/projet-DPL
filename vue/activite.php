<?php
$title_head ='LES ACTIVITÉS';
include_once 'header.php'; 
$activite = get_activite();
$personnel = get_personnel_to_user($_SESSION['utilisateur']);

$activite_non_valide = count_activite_non_valide($personnel['id_p']);
$compte = $activite_non_valide['compte'];
?>

<div class="d-flex align-items-center w-45 my-3 ">
    <!-- boutton ajout -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus-circle"></i>
      </button>
      <a href="imprime_activite.php" class="btn btn-secondary mx-2">
            <i class="fas fa-print"></i> 
        </a>
      <!-- Modal enregistrement nouvel tache -->
      <div class="modal" id="myModal">
            <div class="modal-dialog">
                  <div class="modal-content">
                  
                  <!-- Modal Header -->
                        <div class="modal-header">
                              <h4 class="modal-title text-center">Ajouter une nouvel activité</h4>
                              <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                  
                  <!-- Modal body -->
                        <div class="modal-body">
                             <form action="../model/tache.php" method="post" class="form-group">
                                   <label for="description">Déscription</label>
                                   <input type="text" class="form-control" id="description" name="description" placeholder="Entré la description de l'activité">
                                   <label for="id_resp">Résponsable</label>
                                   <!-- combo responsable -->
                                   <select class="form-control" id="id_resp" name="id_resp">
                                   <?php
                                         $personnel = get_personnel();
                                         if (!empty($personnel) && is_array($personnel)):
                                               foreach ($personnel as $key => $value):
                                   ?>
                                         <option value="<?= $value['id_p']?>"><?= $value['nom_p']?></option>
                                         <?php
                                               endforeach;
                                         endif;
                                         ?>
                                   </select>
                                    <label for="date_d" class="form-label">date debut</label>
                                    <input type="date" name="date_d" id="date_d" class="form-control mx-2" placeholder="Entrer la date du debut de l'activiter">
                                    <label for="date_f" class="form-label">date fin</label>
                                    <input type="date" class="form-control mx-2" name="date_f" id="date_f" placeholder="Entrer la date du debut de l'activiter">
                                    
                                    
                                    
                                    <input type="submit" value="AJOUTER" class="btn btn-primary m-2 w-75" name='ajout'>
                             </form>
                        </div>

                  </div>
            </div>
      </div>
      <div class="w-100 text-right">
            <a href="valide_activite.php" class="btn btn-link">validé un activité <sup><div class="badge badge-secondary p-1"><?=$compte?></div></sub></a>
            <a href="calendar.php" class="btn btn-link">calendrier d'activié</a>
      </div>
</div>
<?php if (!empty($_SESSION['message']['text'])):?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
            <?php
                  unset($_SESSION['message']);
            ?>
      </div>
<?php endif; ?>

<!-- Bouton pour afficher la recherche -->
<button class="btn btn-outline-info mb-2 float-right" id="toggle-date-filter">
    <i class="fas fa-filter"></i>
</button>

<!-- Zone de filtre par dates (cachée au départ) -->
<div class="date-filter mb-3 d-none" id="date-filter">
    <form class="form-inline flex-wrap align-items-end">
        <div class="form-group mb-2 mx-2">
            <label for="start-date" class="mr-2">Date de début</label>
            <input type="date" id="start-date" class="form-control">
        </div>

        <div class="form-group mb-2 mx-2">
            <label for="end-date" class="mr-2">Date de fin</label>
            <input type="date" id="end-date" class="form-control">
        </div>

        <div class="form-group mb-2 mx-2">
            <button type="button" id="filter-dates" class="btn btn-primary">
                <i class="fas fa-search mr-1"></i> Filtrer
            </button>
        </div>
    </form>
</div>


<table class="table table-hover" id="mytable">
    <thead>
      <tr>
            <th>Description</th>
            <th>Responsable</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Statut</th>
            <th>Action</th>
      </tr>
    </thead>

        <tbody>
    <?php
    // Afficher toutes les activités si aucun critère de recherche n'a été soumis
    if (!empty($activite) && is_array($activite)):
        foreach ($activite as $key => $value):
                $modalId = "editModal_" . $value['id_a'];
                $supprId = "supprModal_" . $value['id_a'];
    ?>
          <tr>
                <td><?= $value['description'] ?></td>
                <td><?= $value['nom_p'] ?></td>
                <td><?= transformDateFormat($value['date_d']) ?></td>
                <td><?= transformDateFormat($value['date_f']) ?></td>
                <td><?= get_statut($value['date_d'], $value['date_f'],$value['expired'])?></td>
                <td>
                        <!-- Button ouvre modal modification -->
                        <button type="button" class="btn-sm btn-outline-success border-0" data-toggle="modal" data-target="#<?= $modalId ?>">
                              <i class="fas fa-pen"></i>
                        </button>
                        <?php
                              include '../include/modal_modification.php';
                        ?>
                        
                                    
                        <button type="button" class="btn-sm btn-outline-danger border-0" data-toggle="modal" data-target="#<?= $supprId ?>">
                              <i class="fas fa-trash"></i>
                        </button>
                        <?php
                              include '../include/modal_suppression.php';
                        ?>      
                 </td>
          </tr>
          <?php
          endforeach;
        endif;
          ?>
        </tbody>    
</table>
      
<?php
include_once 'footer.php';
?>