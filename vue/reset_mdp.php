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
            // Vérifier si les mots de passe correspondent
            if ($_POST['new_password'] === $_POST['conf_password']) {

                // Validation avec une expression régulière (regex)
                $password = $_POST['new_password'];
                $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

                // Si le mot de passe ne correspond pas à la regex, afficher un message d'erreur
                if (!preg_match($password_regex, $password)) {
                    $_SESSION['message']['text'] = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
                    $_SESSION['message']['type'] = 'danger';
                } else {
                    // Si la validation est réussie, hachage du mot de passe
                    $new_password = password_hash($password, PASSWORD_BCRYPT);

                    // Mettre à jour le mot de passe et vider le token
                    $updateQuery = "UPDATE login SET password = ?, token = NULL WHERE id_l = ?";
                    $stmt = $connexion->prepare($updateQuery);
                    $stmt->execute([$new_password, $user['id_l']]);

                    // Message de succès
                    $_SESSION['message']['text'] = 'Votre mot de passe a été réinitialisé avec succès.';
                    $_SESSION['message']['type'] = 'success';
                    header('Location: login.php'); // Redirige pour éviter la soumission multiple
                    exit();
                }
            } else {
                $_SESSION['message']['text'] = 'Les mots de passe ne correspondent pas.';
                $_SESSION['message']['type'] = 'danger';
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Réinitialisation du mot de passe</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    color: #fff;
                    font-family: Century Gothic;
                }
                body {
                    background-image: url(../public/images/Background.jpg);
                    background-size: cover;
                    background-repeat: no-repeat;
                    width: 100%;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .card {
                    background-color: #409aa5;
                    box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.4);
                    width: 100%;
                    max-width: 400px;
                    padding: 20px;
                    border-radius: 10px;
                }
                .icon {
                    border: 1px solid #fff;
                    width: 120px;
                    height: 120px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: relative;
                    top: -60px;
                    left: 50%;
                    transform: translateX(-50%);
                    border-radius: 50%;
                    background-color: #00264d;
                }
                .icon i {
                    color: white;
                    font-size: 3rem;
                }
                .form-group {
                    margin-bottom: 15px;
                    border-bottom: 2px solid #fff;
                    margin-left: 40px;
                    margin-right: 40px;
                }
                .form-group input {
                    color: #fff;
                    font-size: 15pt;
                    border: none;
                    background-color: transparent;
                    width: 100%;
                }
                .form-group input:focus {
                    outline: none;
                }
                .btn {
                    width: 100%;
                    background: linear-gradient(90deg, #58578499, #211a37, #8b0fc4);
                    color: white;
                    font-size: 16px;
                    padding: 12px;
                    border: none;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                    background-size: 300% 300%;
                    animation: gradientAnimation 5s ease infinite;
                    transition: transform 0.2s ease, background-color 0.3s ease;
                }
                @keyframes gradientAnimation {
                    0% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                    100% { background-position: 0% 50%; }
                }
                .btn:hover {
                    transform: scale(1.05);
                }
                input {
                    border: none;
                    border-bottom: 2px solid white;
                    background-color: transparent;
                    width: 100%;
                }
                input:focus {
                    outline: none;
                }
                label {
                    animation: bounce 1.5s infinite;
                }
                /* Animation pour les icônes */
                @keyframes bounce {
                    0%, 100% {
                        transform: translateY(0);
                    }
                    50% {
                        transform: translateY(-5px);
                    }
                }
                .eye-icon {
                    position: absolute;
                    right: 10px;
                    top: 10px;
                    cursor: pointer;
                    color: white;
                }
            </style>
        </head>
        <body>

            <div class="container d-flex justify-content-center">
                <div class="card">
                    <div class="icon">
                        <i class="fas fa-unlock fa-5x"></i>
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
                            <div class="mb-3 position-relative">
                                <label for="new_password" class="form-label">Nouveau mot de passe :</label>
                                <input type="password" name="new_password" id="new_password" required placeholder="Entrez votre nouveau mot de passe">
                                <i class="fas fa-eye eye-icon" id="togglePassword1"></i>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="conf_password" class="form-label">Confirmation :</label>
                                <input type="password" name="conf_password" id="conf_password" required placeholder="Confirmer votre nouveau mot de passe">
                                <i class="fas fa-eye eye-icon" id="togglePassword2"></i>
                            </div>
                            <button type="submit" class="btn w-100">Réinitialiser le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // Fonction pour basculer entre afficher/masquer le mot de passe
                const togglePassword1 = document.getElementById('togglePassword1');
                const togglePassword2 = document.getElementById('togglePassword2');
                const passwordField1 = document.getElementById('new_password');
                const passwordField2 = document.getElementById('conf_password');

                togglePassword1.addEventListener('click', function () {
                    const type = passwordField1.type === 'password' ? 'text' : 'password';
                    passwordField1.type = type;
                    this.classList.toggle('fa-eye-slash');
                });

                togglePassword2.addEventListener('click', function () {
                    const type = passwordField2.type === 'password' ? 'text' : 'password';
                    passwordField2.type = type;
                    this.classList.toggle('fa-eye-slash');
                });
            </script>
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
