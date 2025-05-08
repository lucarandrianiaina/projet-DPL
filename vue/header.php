<?php
include_once '../model/fonction.php';

if(empty($_SESSION['utilisateur'])){
    header('Location:login.php');
}
$user = get_utilisateur($_SESSION['utilisateur']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      <?php
      // recuperation de la nom du fichier ouvert
            $current_file_name = basename($_SERVER['PHP_SELF']);
            $title = preg_replace('/\.php$/', '', $current_file_name);
      // afficher le nom comme titre
      if($title == 'index'){
            echo 'Tableau de bord';
      }else{
            echo $title;
      }
      ?>
    </title>
      
    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->

     <link rel="stylesheet" href="../public/vendor/DataTables/datatables.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
        .footer {
    font-size: 0.9rem;
    background-color: #f8f9fc;
}
.footer a {
    color: inherit;
    text-decoration: none;
}
.footer a:hover {
    text-decoration: underline;
}

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6ca3aa;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img src="../public/images/Logo.png" alt="logo E-Gestion" style="width: 150px;">
            </a>

            <!-- separateur -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - personnel -->
            <li class="nav-item active">
                <a class="nav-link" href="personnel.php">
                    <i class="fas fa-users"></i>
                    <span>Pesonnel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - personnel -->
            <li class="nav-item active">
                <a class="nav-link" href="activite.php?act=EC">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Activités</span></a>
            </li>

            <?php if(has_permission($_SESSION['utilisateur'], 'create_post') && has_permission($_SESSION['utilisateur'], 'edit_post') && has_permission($_SESSION['utilisateur'], 'view_post')):?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item active">
                    <a class="nav-link" href="file.php">
                        <i class="fas fa-file"></i>
                        <span>Fichier</span></a>
                </li>
            <?php endif ?>
            <?php if(has_permission($_SESSION['utilisateur'], 'create_post') && has_permission($_SESSION['utilisateur'], 'edit_post') && has_permission($_SESSION['utilisateur'], 'delete_post') && has_permission($_SESSION['utilisateur'], 'view_post')):?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item active">
                    <a class="nav-link" href="utilisateur.php">
                        <i class="fas fa-user-cog"></i>
                        <span>Gérer les utilisateur</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="confirme_utilisateur.php">
                        <i class="fas fa-user"></i>
                        <span>confirmer utilisateur</span></a>
                </li>
            <?php endif ?>
            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                titre menu_1
            </div> -->

            <!-- Nav Item - Pages Collapse Menu
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>menu2</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">titre sous menu:</h6>
                        <a class="collapse-item" href="buttons.html">sous menu1</a>
                        <a class="collapse-item" href="cards.html">sous menu2</a>
                    </div>
                </div>
            </li>
    -->
            <!-- Nav Item - Utilities Collapse Menu 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>menu3</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">titre sous menu:</h6>
                        <a class="collapse-item" href="utilities-color.html">sous menu1</a>
                        <a class="collapse-item" href="utilities-border.html">sous menu2</a>
                    </div>
                </div>
            </li>
             -->
            <!-- button toggle menue -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle">
                    <!-- ::after -->
                </button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- page title -->
                    <h3 class="text-center">
                        <?=$title_head?>
                    </h3>
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user['nom_utilisateur']?></span>
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../model/logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Se deconnécter
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
