<?php
$title_head = 'PROFILE';
include_once 'header.php'
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="../model/envoi_change_mail.php" method="post" class="my-2">
                    <div class="mb-3 form-group">
                        <label for="mail" class="form-label">Nouveau adresse email</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Enter votr nouveu adresse email">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer un mail</button>
                </form>
                  <?php if (!empty($_SESSION['message']['text'])):?>
                        <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
                              <?= $_SESSION['message']['text'] ?>
                              <?php
                                    unset($_SESSION['message']);
                              ?>
                        </div>
                  <?php endif; ?>
                  <?php if (!empty($_SESSION['key'])):?>
                        <h3>CONFIRMER VOTRE CHANGEMENT</h3>
                        <form action="../model/change_mail.php" method="post" class="my-2">
                              <div class="mb-3 form-group">
                                    <label for="key" class="form-label">Clé</label>
                                    <input type="text" class="form-control" id="key" name="key" placeholder="Enter le clé ici" required>
                              </div>
                              <div class="mb-3 form-group">
                                    <label for="mdp" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Enter votre mot de passe" required>
                              </div>
                              <button type="submit" class="btn btn-primary">CONFIRMER</button>
                        </form>
                  <?php endif; ?>
            </div>
        </div>
    </div>
<?php
include_once 'footer.php'
?>
