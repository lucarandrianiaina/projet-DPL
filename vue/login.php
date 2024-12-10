<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Login</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif; /* Police moderne */
}

body {
    background-color: #6ca3aa;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background-color: #409aa5;
    width: 400px;
    height: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.icon {
    background-color: #00264d;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: relative;
    top: -50px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.img-logo {
    position: relative;
    top: -40px;
    width: 180px;
    height: 50px;
}

.form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
    display: flex; /* Utiliser flexbox pour aligner les icônes et les champs sur la même ligne */
    align-items: center; /* Centrer verticalement les éléments */
    width: 80%;
}

.form-group label {
    color: #fff;
    font-size: 16px;
    margin-right: 10px; /* Ajouter un espace entre l'icône et le champ */
}

.form-group input {
    color: #fff;
    font-size: 15pt;
    border: none;
    background-color: transparent;
    width: 100%;
    padding: 12px;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-bottom: 2px solid #fff;
}

.form-group i {
    color: #fff;
    font-size: 20px;
    margin-right: 10px; /* Espacement entre l'icône et le champ */
}

.btn {
    background-color: #00264d;
    color: #fff;
    font-size: 14pt;
    padding: 14px 20px;
    width: 100%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #003366;
}

.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    width: 100%;
}

.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}

@media (max-width: 480px) {
    .container {
        width: 90%;
        padding: 15px;
    }
    .icon {
        width: 80px;
        height: 80px;
        top: -40px;
    }
    .img-logo {
        width: 150px;
    }
    .form-group input {
        font-size: 14pt;
    }
    .btn {
        font-size: 12pt;
        padding: 12px;
    }
}

    </style>
</head>
<body>
    <div class="container">
            <div class="icon">
                <i class="fas fa-user fa-5x"></i>
            </div>
            <img src="../public/images/Logo.png" alt="logo E-gestion" class="img-logo">
            <form action="../model/login.php" method="post" class="form">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user fa-2x"></i></label>
                    <input type="text" class="text-box" name="nom_u" id="name" placeholder="Nom d'utilisateur">
                </div>
                <div class="form-group">
                    <label for="mdp"><i class="fas fa-lock fa-2x"></i></label>
                    <input type="password" class="text-box" name="mdp" id="mdp" placeholder="Mot de passe">
                </div>
                <?php if (!empty($_SESSION['message']['text'])):?>
                    <div class="alert alert-<?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                        <?php
                            unset($_SESSION['message']);
                            ?>
                    </div>
                    <?php endif; ?>
                    <input type="submit" value="LOGIN" class="btn" name="connexion">
                </form>
                <a href="mdp_oublie.php">Mot de passe oublié</a>
    </div>
</body>
</html>