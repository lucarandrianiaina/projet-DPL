<?php
include_once 'header.php'
?>

<div class="d-flex align-items-center w-45 my-3 ">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <!-- boutton ajout -->
            <i class="fas fa-plus-circle"></i>
      </button>
      <!-- bouton pour voir tous les activité -->
      <a href="tous_activite.php" class="btn btn-secondary mx-2">
            <i class="fas fa-eye"></i>
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
                                    <button type="button" class="btn btn-danger m-2" data-dismiss="modal"><i class="fas fa-times"></i></button>
                             </form>
                        </div>

                  </div>
            </div>
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

<!-- les trois tabeau de tache -->
<a href="activite.php?act=AF" class="btn btn-outline-primary <?= $_GET['act']=='AF' ? 'active' : ''?>"><i class="fas fa-hourglass-half"></i> A faire</a>
<a href="activite.php?act=EC" class="btn btn-outline-primary <?=  $_GET['act']=='EC' ? 'active' : ''?>"><i class="fas fa-clock"></i> En cours</a>
<a href="activite.php?act=FN" class="btn btn-outline-primary <?=$_GET['act']=='FN' ? 'active' : ''?>"><i class="fas fa-arrow-right"></i> Finis</a>
<?php
if($_GET['act']=='AF'):
?>
<!-- pour le tache a venir -->
<div class="row my-2">
            <?php
                  $a_faire = get_tache_a_faire();
                  if (!empty($a_faire) && is_array($a_faire)):
                        foreach ($a_faire as $key => $value):
            ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <?php
                              $date_d = new DateTime($value['date_d']);
                              $date_sys = new DateTime(date('Y-m-d'));

                              $reste = $date_sys->diff($date_d);
                              ?>
                        <span class="small float-right">
                              <span class="badge badge-secondary">
                                    <?='j-'.$reste->days?>
                              </span>
                        </span>
                        <h5 class="card-title"><?=$value['description']?></h5>
                        <p class="card-text"> du <?=$value['date_d']?> á <?=$value['date_f']?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <!-- Dropdown - INFO ACTIVITE--> 
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    INFO SUR L'ACTIVITE
                                </h6><hr>
                                <p>Nom de l'activité: <strong><?=$value['description']?></strong></p>
                                <p>Nom de responsable: <strong><?=$value['nom_p']?></strong></p>
                                <p>Commence le: <?=$value['date_d']?></p>
                                <p>Se termine le: <?=$value['date_f']?></p>
                                Il reste <strong><?=$reste->days==1 ? $reste->days.' jour' : $reste->days.' jours'?> </strong> avant l'éxécution

                            </div>
                        </span>
                  </div>
            </div>
      </div>
            <?php
                         endforeach;
                  endif;
            ?>
</div>

<?php
elseif($_GET['act']=='EC' ):
?>
<!-- pour les tache en cour -->
<div class="row my-2">
      <?php
            $en_cours = get_tache_en_cours();
            if (!empty($en_cours) && is_array($en_cours)):
                  foreach ($en_cours as $key => $value):
      ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <?php
                              $date_f = new DateTime($value['date_f']);
                              $date_sys = new DateTime(date('Y-m-d'));

                              $reste = $date_sys->diff($date_f);
                        ?>
                        <span class="small float-right">
                              <span class="badge badge-<?= $reste->days == 0 ? 'danger' : 'info'?>">
                                    <!-- jours restant -->
                                    <?php if($reste->days == 0): ?>
                                          <?='dérnier jour'?>
                                    <?php else: ?>
                                          <?='-'.$reste->days.' j'?>
                                    <?php endif ?>
                              </span>
                        </span>
                        <h5 class="card-title"><?=$value['description']?></h5>
                        <p class="card-text"> du <?=$value['date_d']?> á <?=$value['date_f']?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <!-- Dropdown - INFO ACTIVITE--> 
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    INFO SUR L'ACTIVITE
                                </h6><hr>
                                <p>Nom de l'activité: <strong><?=$value['description']?></strong></p>
                                <p>Nom de responsable: <strong><?=$value['nom_p']?></strong></p>
                                <p>Commence le: <?=$value['date_d']?></p>
                                <p>Se termine le: <?=$value['date_f']?></p>
                                <?=$reste->days==0 ?'dernier jour' : ($reste->days==1 ?'il reste '.$reste->days.' jour' : 'il reste '.$reste->days.' jour')?>

                            </div>
                        </span>
                  </div>
            </div>
      </div>
            <?php
                         endforeach;
                  endif;
            ?>
</div>
<?php
else:
?>
<!-- pour lews tache passé -->
<div class="row my-2">
            <?php
                  $fini = get_tache_fini();
                  if (!empty($fini) && is_array($fini)):
                        foreach ($fini as $key => $value):
            ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <?php
                              $date_f = new DateTime($value['date_f']);
                              $date_sys = new DateTime(date('Y-m-d'));

                              $reste = $date_sys->diff($date_f);
                        ?>
                        <span class="small float-right">
                              <span class="badge badge-<?= $reste->days == 1 ? 'danger' :'secondary'?>">
                                    <?= $reste->days == 1 ? 'hier' :'il y a '.$reste->days.'j'?>
                              </span>
                        </span>
                        <h5 class="card-title"><?=$value['description']?></h5>
                        <p class="card-text"> du <?=$value['date_d']?> á <?=$value['date_f']?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <!-- Dropdown - INFO ACTIVITE--> 
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    INFO SUR L'ACTIVITE
                                </h6><hr>
                                <p>Nom de l'activité: <strong><?=$value['description']?></strong></p>
                                <p>Nom de responsable: <strong><?=$value['nom_p']?></strong></p>
                                <p>Commence le: <?=$value['date_d']?></p>
                                <p>Se termine le: <?=$value['date_f']?></p>
                                <i class="fas fa-hand-point-right"></i> fait

                            </div>
                        </span>
                  </div>
            </div>
      </div>
            <?php
                         endforeach;
                  endif;
            ?>
</div>
<?php
endif;
?>

      
<?php
include_once 'footer.php'
?>