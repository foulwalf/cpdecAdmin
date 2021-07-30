<?php
session_start();
include_once '../../model/admin.php';
testLogin();
$candidats = anciensBacheliersAdmis();
liste("ab");
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPDEC pre-inscriptions</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <!--<li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
            </li>-->
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <!--<style>
                    /* Firefox */
                    input[type=number] {
                        -moz-appearance: textfield;
                    }

                    /* Chrome */
                    input::-webkit-inner-spin-button,
                    input::-webkit-outer-spin-button {
                        -webkit-appearance: none;
                        margin:0;
                    }
                </style>
                <input class="form-control form-control-navbar" type="number" placeholder="Moyenne de sélection" aria-label="Moyenne cpdec" list="moyenneCpdec">
                <datalist id="moyenneCpdec">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </datalist>-->
                <!--<div class="input-group-append">
                    <button class="btn btn-primary" type="">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;<span>Imprimer</span>
                    </button>
                </div>-->
            </div>
        </form>
        <div class="input-group-append">
            <a href="../../model/liste des anciens bacheliers.xls">
                <button class="btn btn-primary">
                    <i class="fas fa-download"></i>&nbsp;&nbsp;<span>Télécharger la liste</span>
                </button>
            </a>
        </div>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Recherche par numéro" aria-label="Search" aria-describedby="basic-addon2" id="myInput" onkeyup="search();">
            </div>
        </form>
        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">

            <span class="brand-text font-weight-light">Préinscriptions CPDEC</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="#" class="d-block">Administrateur</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Liste des candidats
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="listeNouveaux.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveaux bacheliers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="listeAnciens.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Anciens bachelier</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Liste des admis
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="listeNouveauAdmis.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveaux bacheliers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="listeAncienAdmis.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Anciens bachelier</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Liste des refusés
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="listeNouveauRefus.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveaux bacheliers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="listeAncienRefus.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Anciens bachelier</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="../../model/logout.php" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Deconnexion</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Liste des admis (Anciens bacheliers)</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <span class="breadcrumb float-sm-right">
                            <b><?php include_once '../../model/admin.php';
                                echo nombreAdmisAB() ?></b>&nbsp;&nbsp;Admis
                        </span>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Télephone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Nationalité</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Cours</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php $numero_candidat=1 ?>
                    <?php foreach ($candidats as $candidat) { ?>
                        <tr>
                            <th><?= $numero_candidat++?></th>
                            <td><?= $candidat['nom']?></td>
                            <td><?= $candidat['prenom']?></td>
                            <td><?= $candidat['tel']?></td>
                            <td><?= $candidat['email'] ?></td>
                            <td><?= $candidat['nationalite']?></td>
                            <td><?= $candidat['datenaiss']?></td>
                            <td><?= $candidat['cours']?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->

</div>
<!--    <footer class="main-footer">-->
<!-- To the right -->
<!--    <div class="float-right d-none d-sm-inline">-->
<!--      Anything you want-->
<!--    </div>-->
<!-- Default to the left -->
<!--    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">MisterAl</a>.</strong> All rights reserved.-->
<!--    </footer>-->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.min.js"></script>
<script src="../../assets/dist/js/search.js"></script>
</body>
</html>

