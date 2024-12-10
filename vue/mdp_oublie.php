<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <!-- Lien vers la feuille de style de Bootstrap (version 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Conteneur principal pour centrer le formulaire -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <!-- Formulaire de demande de réinitialisation -->
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <h3>Réinitialisation du mot de passe</h3>
            </div>
            <div class="card-body">
                <form action="../model/envoi_lien_token.php" method="post">
                    <!-- Champ Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail :</label>
                        <input type="email" class="form-control" name="email" required placeholder="Entrez votre e-mail">
                    </div>
                    <?php if (!empty($_SESSION['message']['text'])):?>
                        <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
                              <?= $_SESSION['message']['text'] ?>
                              <?php
                                    unset($_SESSION['message']);
                              ?>
                        </div>
                  <?php endif; ?>
                    <!-- Bouton de soumission -->
                    <button type="submit" class="btn btn-primary w-100">Envoyer le lien</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Lien vers le script Bootstrap JavaScript (optionnel pour certains composants comme les modals ou alertes) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

