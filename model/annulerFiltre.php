<?php
session_start();
$_SESSION['moyenneLimite'] = null;
header("location: ../views/pages/listeNouveaux.php");
