<?php
$title_head = 'TABLEAU DE BORD';
include_once 'header.php';

// Vérification de l'existence de 'act' dans $_GET
$act = isset($_GET['act']) ? $_GET['act'] : 'FN';
?>

<div class="row my-2">
      <!-- Boutons pour les trois catégories de tâches -->
      <a href="index.php?act=AF" class="btn btn-outline-primary <?= $act == 'AF' ? 'active' : '' ?>"><i class="fas fa-hourglass-half"></i> À faire</a>
      <a href="index.php?act=EC" class="btn btn-outline-primary <?= $act == 'EC' ? 'active' : '' ?> mx-2"><i class="fas fa-clock"></i> En cours</a>
      <a href="index.php?act=FN" class="btn btn-outline-primary <?= $act == 'FN' ? 'active' : '' ?>"><i class="fas fa-arrow-right"></i> Finies</a>
</div>

<?php
// Section "À faire"
if ($act == 'AF'):
?>
<div class="row">
      <?php
      $a_faire = get_tache_a_faire();
      if (!empty($a_faire) && is_array($a_faire)):
      foreach ($a_faire as $value):
            $date_d = new DateTime($value['date_d']);
            $date_sys = new DateTime(date('Y-m-d'));
            $reste = $date_sys->diff($date_d);
      ?>
      <div class="col-md-4">
            <div class="card mb-4">
                  <div class="card-body">
                        <span class="badge badge-secondary" style="float:right;">j-<?= $reste->days ?></span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <p class="card-text">Résponsable: <b><?= $value['nom_p'] ?></b></p>
                        
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php
// Section "En cours"
elseif ($act == 'EC'):
?>
<div class="row">
      <?php
      $en_cours = get_tache_en_cours();
      if (!empty($en_cours) && is_array($en_cours)):
      foreach ($en_cours as $value):
            $date_f = new DateTime($value['date_f']);
            $date_sys = new DateTime(date('Y-m-d'));
            $reste = $date_sys->diff($date_f);
      ?>
      <div class="col-md-4">
            <div class="card mb-4">
                  <div class="card-body">
                        <span class="badge badge-<?= $reste->days == 0 ? 'danger' : 'info' ?>" style="float:right;">
                        <?= $reste->days == 0 ? 'dernier jour' : '-' . $reste->days . ' j' ?>
                        </span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <p class="card-text">Résponsable: <b><?= $value['nom_p'] ?></b></p>
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php
// Section "Finies"
else:
?>
<div class="row">
      <?php
      $fini = get_tache_fini();
      if (!empty($fini) && is_array($fini)):
      foreach ($fini as $value):
            $date_f = new DateTime($value['date_f']);
            $date_sys = new DateTime(date('Y-m-d'));
            $reste = $date_sys->diff($date_f);
      ?>
      <div class="col-md-4">
            <div class="card mb-4">
                  <div class="card-body">
                        <span class="badge badge-<?= $reste->days == 1 ? 'danger' : 'secondary' ?>" style="float:right;">
                              <?= $reste->days == 1 ? 'hier' : 'il y a ' . $reste->days . 'j' ?>
                        </span>
                        <h5 class="card-title"><?= $value['description'] ?></h5>
                        <p class="card-text">Du <?= $value['date_d'] ?> au <?= $value['date_f'] ?></p>
                        <p class="card-text">Résponsable: <b><?= $value['nom_p'] ?></b></p>
                  </div>
            </div>
      </div>
      <?php endforeach; endif; ?>
</div>

<?php endif; ?>

<?php include_once 'footer.php'; ?>
