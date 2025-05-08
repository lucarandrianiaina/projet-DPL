<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        /* Styles pour le chargement et la page */
        *{
            margin: 0;
            padding: 0;
            font-family: Century Gothic;
        }
        body{
            background-image: url(../public/images/Background.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        a{
            font-size: small;
            text-decoration: none;
            color: #fff;
            margin-bottom: 2px;
        }
        a:hover{
            transform: scale(1.05);
            color: brown;
        }
        .container{
            background-color: #409aa5;
            width: 400px;
            height: 400px;
            display: flex;
            align-items: center;
            flex-direction: column;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.4);
        }
        .icon{
            background-color: #00264d;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            position: relative;
            top: -75px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .img-logo{
            position: relative;
            top: -80px;
            width: 200px;
            height: 50px;
        }
        .form{
            position: relative;
            top: -60px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group{
            margin-bottom: 15px;
            border-bottom: 2px solid #fff;
            margin-left: 40px;
            margin-right: 40px;
        }
        .form-group input{
            color: #fff;
            font-size: 15pt;
            border: none;
            background-color: transparent;
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
        .form-group input:focus{
            outline: none;
        }
        i{
            margin-right: 5px;
            margin-bottom: 5px;
            color: #fff;
        }
        .icon-label{
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


        /* Loader Animation */
        .loader {
          scale: 3;
          height: 50px;
          width: 40px;
        }

        .box {
          position: relative;
          opacity: 0;
          left: 10px;
        }

        .side-left {
          position: absolute;
          background-color: #286cb5;
          width: 19px;
          height: 5px;
          transform: skew(0deg, -25deg);
          top: 14px;
          left: 10px;
        }

        .side-right {
          position: absolute;
          background-color: #2f85e0;
          width: 19px;
          height: 5px;
          transform: skew(0deg, 25deg);
          top: 14px;
          left: -9px;
        }

        .side-top {
          position: absolute;
          background-color: #5fa8f5;
          width: 20px;
          height: 20px;
          rotate: 45deg;
          transform: skew(-20deg, -20deg);
        }

        .box-1 {
          animation: from-left 4s infinite;
        }

        .box-2 {
          animation: from-right 4s infinite;
          animation-delay: 1s;
        }

        .box-3 {
          animation: from-left 4s infinite;
          animation-delay: 2s;
        }

        .box-4 {
          animation: from-right 4s infinite;
          animation-delay: 3s;
        }

        @keyframes from-left {
          0% {
            z-index: 20;
            opacity: 0;
            translate: -20px -6px;
          }

          20% {
            z-index: 10;
            opacity: 1;
            translate: 0px 0px;
          }

          40% {
            z-index: 9;
            translate: 0px 4px;
          }

          60% {
            z-index: 8;
            translate: 0px 8px;
          }

          80% {
            z-index: 7;
            opacity: 1;
            translate: 0px 12px;
          }

          100% {
            z-index: 5;
            translate: 0px 30px;
            opacity: 0;
          }
        }

        @keyframes from-right {
          0% {
            z-index: 20;
            opacity: 0;
            translate: 20px -6px;
          }

          20% {
            z-index: 10;
            opacity: 1;
            translate: 0px 0px;
          }

          40% {
            z-index: 9;
            translate: 0px 4px;
          }

          60% {
            z-index: 8;
            translate: 0px 8px;
          }

          80% {
            z-index: 7;
            opacity: 1;
            translate: 0px 12px;
          }

          100% {
            z-index: 5;
            translate: 0px 30px;
            opacity: 0;
          }
        }
    </style>
</head>
<body>
    <!-- Loader Animation -->
    <div class="loader-container" id="loader">
        <div class="loader">
        <div class="box box-1">
            <div class="side-left"></div>
            <div class="side-right"></div>
            <div class="side-top"></div>
        </div>
        <div class="box box-2">
            <div class="side-left"></div>
            <div class="side-right"></div>
            <div class="side-top"></div>
        </div>
        <div class="box box-3">
            <div class="side-left"></div>
            <div class="side-right"></div>
            <div class="side-top"></div>
        </div>
        <div class="box box-4">
            <div class="side-left"></div>
            <div class="side-right"></div>
            <div class="side-top"></div>
        </div>
        </div>
    </div>

    <!-- Contenu de la page -->
    <div id="content" class="container" style="display: none;">
        <i class="far fa-user-circle icon fa-10x"></i>
        <img src="../public/images/Logo.png" alt="logo E-gestion" class="img-logo">
        <form action="../model/login.php" method="post" class="form">
            <div class="form-group">
                <label for="name" class="icon-label"><i class="fas fa-user fa-2x"></i></label>
                <input type="text" class="text-box" name="nom_u" id="name" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-group">
                <label for="mdp" class="icon-label"><i class="fas fa-lock fa-2x"></i></label>
                <input type="password" class="text-box" name="mdp" id="mdp" placeholder="Mot de passe">
                <i class="fas fa-eye eye-icon m-0 p-0" id="togglePassword"></i>
            </div>
            <input type="submit" value="LOGIN" class="btn" name="connexion">
        </form>
        <a href="mdp_oublie.php">Mot de passe oublié</a>
        <a href="creat_compte.php">créer mon compte</a>

        <!-- Affichage des messages d'alerte -->
        <?php if (!empty($_SESSION['message']['text'])): ?>
            <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']['text'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('mdp');
        togglePassword.addEventListener('click', function () {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye-slash');
        });

        // Fonction pour cacher le loader et afficher le contenu après un délai
        window.onload = function() {
            setTimeout(function() {
                // Masquer l'animation de loading
                document.getElementById("loader").style.display = "none";

                // Afficher le contenu de la page
                document.getElementById("content").style.display = "block";
            }, 3000); // 3000 millisecondes = 3 secondes
        }
    </script>
</body>
</html>
