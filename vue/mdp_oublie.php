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
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            color: #fff;
            font-family: Century Gothic;
        }
        body{
            background-image: url(../public/images/Background.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .card{
            background-color: #409aa5;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.4);
        }
        .form{
            display: flex;
        }
        input {
            border: none;
            border-bottom: 2px solid white;
            background-color: transparent;
            width: 100%;
        }
        input:focus{
            outline: none;
        }
        label{
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
        i{
            color: white;
        }
        .icon{
            border: 1px solid #fff;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; /* Position absolue par rapport au conteneur */
            top: 50%; /* Positionne l'élément à 50% de la hauteur du conteneur */
            left: 50%; /* Positionne l'élément à 50% de la largeur du conteneur */
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background-color: #00264d;
        }
        .btn{
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

    </style>
</head>
<body>

    <!-- Conteneur principal pour centrer le formulaire -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <!-- Formulaire de demande de réinitialisation -->
        <div class="card" style="width: 100%; max-width: 400px;">
                <div class="icon">
                    <i class="fas fa-unlock fa-5x"></i>
                </div>
            <div class="card-body">
                <form action="../model/envoi_lien_token.php" method="post">
                    <!-- Champ Email -->
                    <div class="mb-3 form">
                        <label for="email" class="icon-label"><i class="fas fa-envelope fa-2x mx-1"></i></label>
                        <input type="email" class="" name="email" required placeholder="Entrez votre e-mail">
                    </div>
                    <!-- Affichage des messages d'alerte -->
                    <?php if (!empty($_SESSION['message']['text'])): ?>
                            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
                                <?= $_SESSION['message']['text'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
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

