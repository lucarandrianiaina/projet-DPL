<?php
include_once 'header.php';

// Vérification de l'existence de 'act' dans $_GET
$act = isset($_GET['act']) ? $_GET['act'] : 'FN';
?>

<div class="row">
      <!-- Boutons pour les trois catégories de tâches -->
      <a href="index.php?act=AF" class="btn btn-outline-primary <?= $act == 'AF' ? 'active' : '' ?>"><i class="fas fa-hourglass-half"></i> À faire</a>
      <a href="index.php?act=EC" class="btn btn-outline-primary <?= $act == 'EC' ? 'active' : '' ?> mx-2"><i class="fas fa-clock"></i> En cours</a>
      <a href="index.php?act=FN" class="btn btn-outline-primary <?= $act == 'FN' ? 'active' : '' ?>"><i class="fas fa-arrow-right"></i> Finies</a>
</div>

<?php
// Section "À faire"
if ($act == 'AF'):
?>
<div class="row my-2">
      <?php
      $a_faire = get_tache_a_faire();
      if (!empty($a_faire) && is_array($a_faire)):
            foreach ($a_faire as $value):
                  $date_d = new DateTime($value['date_d']);
                  $date_sys = new DateTime(date('Y-m-d'));
                  $reste = $date_sys->diff($date_d);
      ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <span class="small float-right">
                              <span class="badge badge-secondary">
                                    <?= 'j-' . $reste->days ?>
                              </span>
                        </span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">INFO SUR L'ACTIVITÉ</h6><hr>
                                    <p>Nom de l'activité: <strong><?= $value['description'] ?></strong></p>
                                    <p>Nom du responsable: <strong><?= $value['nom_p'] ?></strong></p>
                                    <p>Commence le: <?= $value['date_d'] ?></p>
                                    <p>Se termine le: <?= $value['date_f'] ?></p>
                                    Il reste <strong><?= $reste->days == 1 ? $reste->days . ' jour' : $reste->days . ' jours' ?> </strong> avant l'exécution
                              </div>
                        </span>
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php
// Section "En cours"
elseif ($act == 'EC'):
?>
<div class="row my-2">
      <?php
      $en_cours = get_tache_en_cours();
      if (!empty($en_cours) && is_array($en_cours)):
            foreach ($en_cours as $value):
                  $date_f = new DateTime($value['date_f']);
                  $date_sys = new DateTime(date('Y-m-d'));
                  $reste = $date_sys->diff($date_f);
      ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <span class="small float-right">
                              <span class="badge badge-<?= $reste->days == 0 ? 'danger' : 'info' ?>">
                                    <?= $reste->days == 0 ? 'dernier jour' : '-' . $reste->days . ' j' ?>
                              </span>
                        </span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">INFO SUR L'ACTIVITÉ</h6><hr>
                                    <p>Nom de l'activité: <strong><?= $value['description'] ?></strong></p>
                                    <p>Nom du responsable: <strong><?= $value['nom_p'] ?></strong></p>
                                    <p>Commence le: <?= $value['date_d'] ?></p>
                                    <p>Se termine le: <?= $value['date_f'] ?></p>
                                    <?= $reste->days == 0 ? 'dernier jour' : 'il reste ' . $reste->days . ' jour' ?>
                              </div>
                        </span>
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php
// Section "Finies"
else:
?>
<div class="row my-2">
      <?php
      $fini = get_tache_fini();
      if (!empty($fini) && is_array($fini)):
            foreach ($fini as $value):
                  $date_f = new DateTime($value['date_f']);
                  $date_sys = new DateTime(date('Y-m-d'));
                  $reste = $date_sys->diff($date_f);
      ?>
      <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-lg" style="width: 18rem;">
                  <div class="card-body">
                        <span class="small float-right">
                              <span class="badge badge-<?= $reste->days == 1 ? 'danger' : 'secondary' ?>">
                                    <?= $reste->days == 1 ? 'hier' : 'il y a ' . $reste->days . 'j' ?>
                              </span>
                        </span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <span class="float-right">
                              <a class="nav-link dropdown-toggle btn btn-outline-primary" href="#" id="alertsDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-info-circle"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">INFO SUR L'ACTIVITÉ</h6><hr>
                                    <p>Nom de l'activité: <strong><?= $value['description'] ?></strong></p>
                                    <p>Nom du responsable: <strong><?= $value['nom_p'] ?></strong></p>
                                    <p>Commence le: <?= $value['date_d'] ?></p>
                                    <p>Se termine le: <?= $value['date_f'] ?></p>
                                    <i class="fas fa-hand-point-right"></i> fait
                              </div>
                        </span>
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php endif; ?>

<?php include_once 'footer.php'; ?>
