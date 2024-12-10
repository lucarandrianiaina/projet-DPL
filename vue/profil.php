<?php
$title_head = 'PROFILE';
include_once 'header.php';

$user_connected = get_utilisateur($_SESSION['utilisateur'])
?>

<i class="fas fa-user-cog fa-5x my-2"></i>
<div class="border">
      <div class="container">
            <p>
                  Nom d'utilisateur : <b> <?=$user_connected['nom_utilisateur'];?></b>
                  <a href="#" class="mx-5" data-toggle="modal" data-target="#change_nom">Modifié</a>
            </p>
            <!-- modal modification nom d'utilisateur -->
            <div class="modal" id="change_nom" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <h4 class="modal-title">Modification nom d'utilisateur</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                              </div>
                              <div class="modal-body">
                                    <form action="../model/modif_user.php" method="post">
                                          <div class="form-group">
                                                <label for="nom_u" class="form-label">nouveau nom</label>
                                                <input type="text" class="form-control" name="nom_u" id="nom_u" placeholder="Met ici votre nouveau nom d'utilisateur">
                                          </div>
                                          <div class="form-group">
                                                <label for="mdp" class="form-label">Mot de passe</label>
                                                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="votre mot de passe pour confirmer">
                                          </div>
                                          <input type="submit" class="btn btn-primary w-100" value="MODIFIER">
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
            <p>
                  Adresse mail : <b> <?=$user_connected['mail'];?></b>
                  <a href="change_mail.php" class="mx-5">Modifié</a>
            </p>
            <p>
                  <a href="#" data-toggle="modal" data-target="#change_mdp">Chager le mot de passe</a>
                  <!-- modale chager mdp -->
                  <div class="modal" id="change_mdp" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h4 class="modal-title">Modification mot de passe</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                    </div>
                                    <div class="modal-body">
                                          <form action="../model/change_mdp.php" method="post">
                                                <div class="form-group">
                                                      <label for="mdp" class="form-label">Mot de passe</label>
                                                      <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe ">
                                                </div>
                                                <div class="form-group">
                                                      <label for="n_mdp" class="form-label">Nouveau mot de passe</label>
                                                      <input type="password" class="form-control" name="n_mdp" id="n_mdp" placeholder="votre nouveau mot de passe">
                                                </div>
                                                <div class="form-group">
                                                      <label for="conf_mdp" class="form-label">confirmer le mot de passe</label>
                                                      <input type="password" class="form-control" name="conf_mdp" id="conf_mdp" placeholder="confirmer votre nouveau mot de passe">
                                                </div>
                                                <input type="submit" class="btn btn-primary w-100" value="MODIFIER">
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </p>
      </div>
</div>
<?php if (!empty($_SESSION['message']['text'])):?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?> my-2">
            <?= $_SESSION['message']['text'] ?>
            <?php
                  unset($_SESSION['message']);
            ?>
      </div>
<?php endif; ?>

<?php
include_once 'footer.php';
?>