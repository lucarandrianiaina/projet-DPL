<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include('../model/fonction.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Vérifier si le token est valide
    $query = "SELECT * FROM login WHERE token = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Traitement du formulaire de réinitialisation de mot de passe
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

            // Mettre à jour le mot de passe et vider le token
            $updateQuery = "UPDATE login SET password = ?, token = NULL WHERE id_l = ?";
            $stmt = $connexion->prepare($updateQuery);
            $stmt->execute([$new_password, $user['id_l']]);

            // Message de succès
            $_SESSION['message']['text']= 'Votre mot de passe a été réinitialisé avec succès.';
            $_SESSION['message']['type'] = 'success';
            header('Location: login.php'); // Redirige pour éviter la soumission multiple
            exit();
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Réinitialisation du mot de passe</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="card" style="width: 100%; max-width: 400px;">
                    <div class="card-header text-center">
                        <h3>Réinitialiser votre mot de passe</h3>
                    </div>
                    <div class="card-body">

                        <!-- Affichage des messages d'alerte -->
                        <?php if (!empty($_SESSION['message']['text'])): ?>
                            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
                                <?= $_SESSION['message']['text'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
                        <?php endif; ?>

                        <!-- Formulaire de réinitialisation du mot de passe -->
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe :</label>
                                <input type="password" class="form-control" name="new_password" required placeholder="Entrez votre nouveau mot de passe">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Réinitialiser le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        // Message d'erreur pour token invalide ou expiré
        $_SESSION['message'] = [
            'text' => 'Token invalide ou expiré.',
            'type' => 'danger'
        ];
        header('Location: login.php'); // Redirige vers la page de connexion
        exit();
    }
} else {
    // Message d'erreur pour token manquant
    $_SESSION['message'] = [
        'text' => 'Token manquant.',
        'type' => 'danger'
    ];
    header('Location: login.php'); // Redirige vers la page de connexion
    exit();
}
?>
