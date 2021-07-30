<?php

include 'admin.php';
session_start();
$_SESSION['admission_test'] = refuser($_GET['id']);
if($_GET['type'] == "nb"){
    header("location: ../views/listeNouveaux.php");
} else{
    header("location: ../views/listeAnciens.php");
}
