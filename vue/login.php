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
        *{
            margin: 0;
            padding: 0;
            font-family: Century Gothic;
        }
        body{
            background-color: #6ca3aa;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container{
            background-color: #409aa5;
            width: 400px;
            height: 350px;
            display: flex;
            align-items: center;
            flex-direction: column;
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
            background-color: #00264d;
            color: #fff;
            font-size: 10pt;
            position: relative;
            bottom: -40px;
            width: 90%;
            height: 50px;
            border: none;
            cursor: pointer;
        }
        .form-group input:focus{
            outline: none;
        }
        i{
            margin-right: 5px;
            margin-bottom: 5px;
            color: #fff;
        }
        .alert {
        padding: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
        margin-bottom: 20px;
        }
        .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
        }
        @media (max-width: 480px) {
            .container {
                width: 90%;
                height: auto;
                padding: 10px;
            }
            .icon {
                width: 100px;
                height: 100px;
                top: -50px;
            }
            .img-logo {
                width: 150px;
            }
            .form-group input {
                font-size: 13pt;
            }
            .btn {
                font-size: 12pt;
                height: 45px;
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
    </div>
</body>
</html>