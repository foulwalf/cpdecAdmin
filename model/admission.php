<?php

include 'admin.php';
session_start();

$_SESSION['admission_test'] = admettre($_GET['id']);

if ($_GET['type'] == "nb") {
    header("location: ../views/pages/listeNouveaux.php");
} else {
    header("location: ../views/pages/listeAnciens.php");
}
