<?php
session_start();
include_once '../../model/admin.php';
testLogin();
if (isset($_POST['moyenneLimite'])) {
    $_SESSION['moyenneLimite'] = $_POST['moyenneLimite'];
}
if (isset($_SESSION['moyenneLimite'])) {
    $requete = nouveauBacheliersRefus($_SESSION['moyenneLimite']);

    $candidats = $requete['candidats'];
    $nombre = $requete['nombre'];
} else {
    $candidats = nouveauBacheliersRefus(null);
}
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../assets/dist/css/adminlte.css">
        <style>
            .dropdown-menu-perso {
                list-style: none;
                position: absolute;
                background: white;
                padding: 0;
                display: none;
            }

            .dropdown:hover .dropdown-menu-perso {
                display: block;
            }
        </style>
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
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" method="post">
                <div class="input-group input-group-sm">
                    <style>
                        /* Firefox */
                        input[type=number] {
                            -moz-appearance: textfield;
                        }

                        /* Chrome */
                        input::-webkit-inner-spin-button,
                        input::-webkit-outer-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                    </style>
                    <input class="form-control form-control-navbar" type="number" placeholder="Moyenne de sélection" aria-label="Moyenne cpdec" list="moyenneCpdec" name="moyenneLimite" required>
                    <datalist id="moyenneCpdec">
                        <?php for ($i = 1; $i <= 20; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </datalist>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="limiter">
                            <i class="fas fa-check"></i>&nbsp;&nbsp;<span>Filtrer</span>
                        </button>
                    </div>
                    &nbsp;&nbsp;
                    <div class="input-group-append">
                        <button class="btn btn-danger" name="filtrer" onclick="destroyFilter()">
                            <i class="fas fa-times"></i>&nbsp;&nbsp;<span>Annuler le filtre</span>
                        </button>
                    </div>
                </div>
            </form>
            <?php if (isset($_SESSION['moyenneLimite'])) { ?>
                <div class="col-md-6">
                    <span>Moyenne cpdec >= <?= $_SESSION['moyenneLimite'] ?> : <?= $nombre ?> candidat<?= $nombre > 1 ? "s" : "" ?></span>
                </div>
            <?php } ?>
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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                            <a href="#" class="nav-link">
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
                                    <a href="listeAncienAdmis.php" class="nav-link">
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
                                    Liste des refusés
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="listeNouveauRefus.php" class="nav-link active">
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
        <div class="content-wrapper" style="width: fit-content;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Liste des refusés (Nouveaux bacheliers)</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <span class="breadcrumb float-sm-right">
                                <b><?php include_once '../../model/admin.php';
                                    echo nombreRefusNB() ?></b>&nbsp;&nbsp;Refusé<?php include_once '../../model/admin.php'; echo nombreRefusNB() > 1 ? "s" : ""; ?>
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
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Télephone</th>
                            <th scope="col">Nationalité</th>
                            <th scope="col">Âge</th>
                            <th scope="col">Etablissement</th>
                            <th scope="col">Serie</th>
                            <th scope="col">UE</th>
                            <th scope="col">Moyenne CPDEC</th>
                            <th scope="col">Fichiers</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php foreach ($candidats as $candidat) { ?>
                            <tr>
                                <td><?= utf8_decode($candidat['nom']) ?></td>
                                <td><?= utf8_decode($candidat['prenom']) ?></td>
                                <td><?= $candidat['tel'] ?></td>
                                <td><?= utf8_decode($candidat['nationalite']) ?></td>
                                <td><?= date_diff(new DateTime($candidat['datenaiss']), new DateTime(date("Y/m/d")))->format('%y') ?></td>
                                <td><?= utf8_decode($candidat['etablissementorg']) ?></td>
                                <td><?= $candidat['serie'] ?></td>
                                <td><?= $candidat['ue'] ?></td>
                                <td><?= round($candidat['moyennecpdec'], 2) ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Fichiers
                                        </button>
                                        <ul class="dropdown-menu-perso" aria-labelledby="dropdownMenu2">
                                            <?php include_once '../../model/admin.php';
                                            $fichiers = fichiers($candidat['id_candidat']); ?>
                                            <?php foreach ($fichiers as $fichier) { ?>
                                                <li>
                                                    <a href="../../../fichiers/<?= $candidat["nom"] . " " . $candidat["prenom"] . " " . $candidat["id_candidat"] . "/" . $fichier["url"] ?>"
                                                       target="_blank">
                                                        <button class="dropdown-item"
                                                                type="button"><?= $fichier['nom_fichier'] ?></button>
                                                    </a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu-perso" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <a href="../../model/admission.php?id=<?= $candidat['id_candidat'] ?>&type=ab">
                                                    <button style="width: 83.85px; height: 38px; margin: 5% 0;"
                                                            type="button" class="btn btn-primary"
                                                            onclick="return(confirm('Voulez vous vraiment '+this.innerHTML.toLowerCase()+' le canditat <?= $candidat['nom'] ?>  <?= $candidat['prenom'] ?>'))">
                                                        Accepter
                                                    </button>
                                                </a></li>
                                            <li><a href="../../model/refus.php?id=<?= $candidat['id_candidat'] ?>&type=ab">
                                                    <button style="width: 83.85px; height: 38px; margin: 5% 0;"
                                                            type="button" class="btn btn-danger"
                                                            onclick="return(confirm('Voulez vous vraiment '+this.innerHTML.toLowerCase()+' le canditat <?= $candidat['nom'] ?>  <?= $candidat['prenom'] ?>'))">
                                                        Refuser
                                                    </button>
                                                </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

        <!-- Main Footer -->

    </div>

    <script>
        function destroyFilter() {
            location.href = "../../model/annulerFiltre.php";
        }
    </script>

    <!-- jQuery -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>

    <script src="../../assets/plugins/bootstrap-notify.js"></script>
    <script type="text/javaScript">
        <?php
        if (isset($_SESSION['admission_test'])) {
        $test = $_SESSION['admission_test'];
        $_SESSION['admission_test'] = null ?>
        var test = <?= json_encode($test); ?>;
        //alert(test);

        if(test == "admis"){
            $.notify({
                icon:'fas fa-check-circle',
                message:'Candidat accepté'
            },{
                type:'success',
                offset: {
                    x:0,
                    y:20
                },
                placement: {
                    from :'bottom',
                    align: 'right'
                },
                delay: 1000
            })
        } else if (test == 'refusé'){
            $.notify({
                icon:'fas fa-exclamation-circle',
                message:'Candidat refusé'
            },{
                type:'danger',
                offset: {
                    x:0,
                    y:20
                },
                placement: {
                    from :'bottom',
                    align : 'right'
                },
                delay: 1000
            })
        } else{
            $.notify({
                icon:'fas fa-exclamation-circle',
                message:'Une erreur s\'est produite veuillez réesayer'
            },{
                type:'danger',
                offset: {
                    x:0,
                    y:20
                },
                placement: {
                    from :'bottom',
                    align : 'right'
                },
                delay: 1000
            })
        }
        <?php } ?>
    </script>

    <script src="../../assets/dist/js/search.js"></script>
    </body>

    </html>
<?php $test = null ?>