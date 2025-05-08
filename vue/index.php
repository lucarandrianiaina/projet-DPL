<?php
$title_head = 'TABLEAU DE BORD';
include_once 'header.php';
$personnel = get_personnel_to_user($_SESSION['utilisateur']);
$id_p = $personnel['id_p'];

$expired = count_activite_expire($id_p);

$termine = count_activite_termine($id_p);

$en_cours = count_activite_en_cours($id_p);

$realise = count_activite_a_faire($id_p)
?>
  <!-- Content Row -->
  <h5>Activités sous votre résponsabilité</h5>
  <div class="row">
    <!-- À réaliser Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                À réaliser
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $realise['realise']; ?> <!-- Afficher le nombre d'activités à réaliser -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> <!-- Icône représentant le temps restant -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- En cours Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                En cours
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $en_cours['en_cours']; ?> <!-- Afficher le nombre d'activités en cours -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-sync-alt fa-2x text-gray-300"></i> <!-- Icône représentant le temps qui tourne -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Terminées Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Términées
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?= $termine['termine']; ?> <!-- Afficher le nombre d'activités terminées -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-flag-checkered fa-2x text-gray-300"></i> <!-- Icône représentant la progression -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Expirés Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Expirés
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $expired['nombre_activites']; ?> <!-- Afficher le nombre d'activités expirées -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar-times fa-2x text-gray-300"></i> <!-- Icône représentant une boîte, symbolisant l'expiration -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php include_once 'footer.php'; ?>