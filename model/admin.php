<?php
function login($email, $psswd)
{
    include '../mvc/config.php';
    if ($email == $connexion_email && $psswd == $connexion_password) {
        $_SESSION['state'] = "connected";
        header("location: views/pages/listeNouveaux.php");
    } else {
        return false;
    }
}

function testLogin()
{
    if (!isset($_SESSION['state'])) {
        header("location: ../../index.php");
    }
}

//recuperer le nombre des inscrits
//nouveaux bacheliers
function nombreDInscritsNB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//anciens bacheliers
function nombreInscritsAB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
//nouveaux bacheliers admis
function nombreAdmisNB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat where etat = 1");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
//anciens bacheliers admis
function nombreAdmisAB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat where etat = 1");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}//nouveaux bacheliers refusé
function nombreRefusNB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat where etat = 0");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
//anciens bacheliers admis
function nombreRefusAB()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select count(*) as total  from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat where etat = 0");
        $nombre = $query->fetch();
        if ($query) {
            return $nombre['total'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// recuperer les candidats
//nouveaux bacheliers
//informations
function nouveauBacheliersInscrits($moy_limit)
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        if ($moy_limit == null) {
            $query = $connexion->query("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier where etat is NULL order by nom asc");
            $candidats = $query->fetchAll();
        } else {
            $query = $connexion->prepare("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier where etat is NULL AND (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 >= ? order by moyennecpdec desc");
            $execution = $query->execute(array($moy_limit));
            $candidats = $query->fetchAll();
        }
        if ($query) {
            if ($moy_limit == null) {
                return $candidats;
            } else {
                return ["candidats" => $candidats, "nombre" => $query->rowCount()];
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}function nouveauBacheliersRefus($moy_limit)
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        if ($moy_limit == null) {
            $query = $connexion->query("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier where etat = 0 order by nom asc");
            $candidats = $query->fetchAll();
        } else {
            $query = $connexion->prepare("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier where etat = 0 AND (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 >= ? order by moyennecpdec desc");
            $execution = $query->execute(array($moy_limit));
            $candidats = $query->fetchAll();
        }
        if ($query) {
            if ($moy_limit == null) {
                return $candidats;
            } else {
                return ["candidats" => $candidats, "nombre" => $query->rowCount()];
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//fichiers
function fichiers($id)
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->prepare("select * from fichier where candidat = ?");
        $execution = $query->execute(array($id));
        $candidat_files = $query->fetchAll();
        if ($query) {
            return $candidat_files;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//anciens
//info
function anciensBacheliersInscrits()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select * from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat where etat is NULL order by nom");
        $candidats = $query->fetchAll();
        if ($query) {
            return $candidats;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function anciensBacheliersRefus()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select * from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat where etat = 0 order by nom");
        $candidats = $query->fetchAll();
        if ($query) {
            return $candidats;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// actions
//admission
function admettre($id)
{
    try {
        include '../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $query = $connexion->prepare("UPDATE candidat SET etat = 1 WHERE id_candidat = ?");
            $execution = $query->execute([$id]);
        if ($execution) {
            return 'admis';
        } else {
            return $execution;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//refus
function refuser($id)
{
    try {
        include '../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $query = $connexion->prepare("UPDATE candidat SET etat = 0 WHERE id_candidat = ?");
            $execution = $query->execute([$id]);
        if ($execution) {
            return 'refusé';
        } else {
            return $execution;
        }


    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//admis
//nouveau bacheliers
function nouveauBacheliersAdmis()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier where etat = 1 order by nom asc");
        return $query->fetchAll();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//anciens bacheliers
function anciensBacheliersAdmis()
{
    try {
        include '../../../mvc/config.php';
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $query = $connexion->query("select * from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat where etat = 1 order by nom asc");
        return $query->fetchAll();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function liste($type) {
    include "../../../mvc/config.php";
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    if ($type === "nb") {
        $query = $connexion->query("select *, (moyannfran+moyannang+moyannmath + (notebacfran*2) + (notebacmath*2) + notebacang + moybac + mga)/10 as moyennecpdec from candidat join nouveaubachelier on candidat.id_candidat = nouveaubachelier.candidat join note on candidat.id_candidat = note.nouveaubachelier join parent on candidat.parent = parent.id_parent where etat = 1 order by nom asc");
        $candidats_admis = $query->fetchAll();
        $liste = fopen('../../model/liste des nouveaux bacheliers.xls', 'w');
        fputs($liste, utf8_decode("N°\tNom et prénoms\tDate de naissance\tLieu de naissance\tNationalité\tEtablissement\tContact\tE-mail\tUE\tSérie du bac\tMoyenne annuelle en Francais\tMoyenne annuelle en Anglais\tMoyenne annuelle en Math\tNote du bac en Francais\tNote du bac en Anglais\tNote du bac en Math\tMoyenne générale annuelle\tPoint du bac\tMoyenne du bac\tMoyenne CPDEC\tNom et prénoms du parent\tContact du parent\tE-mail du parent\tAdresse du parent\n"));
        $i = 0;
        foreach ($candidats_admis as $candidat) {
            $i++;
            fputs($liste, utf8_decode("$i\t" . $candidat["nom"] . " " . $candidat["prenom"] . "\t" . $candidat["datenaiss"] . "\t" . $candidat["lieunaiss"] . "\t" . $candidat["nationalite"] . "\t" . $candidat["etablissementorg"] . "\t" . $candidat["tel"] . "\t" . $candidat["email"] . "\t" . $candidat["ue"] . "\t" . $candidat["serie"] . "\t" . $candidat["moyannfran"] . "\t" . $candidat["moyannang"] . "\t" . $candidat["moyannmath"] . "\t" . $candidat["notebacfran"] . "\t" . $candidat["notebacang"] . "\t" . $candidat["notebacmath"] . "\t" . $candidat["mga"] . "\t" . $candidat["pointbac"] . "\t" . $candidat["moybac"] . "\t" . $candidat["moyennecpdec"] . "\t" . $candidat["nomparent"] . " " . $candidat["prenomparent"] . "\t" . $candidat["telparent"] . "\t" . $candidat["emailparent"] . "\t" . $candidat["adresseparent"] . "\n"));
        }

    } else if ($type === "ab") {
        $query = $connexion->query("select * from candidat join ancienbachelier on candidat.id_candidat = ancienbachelier.candidat join parent on candidat.parent = parent.id_parent where etat = 1 order by nom asc");
        $candidats_admis = $query->fetchAll();
        $liste = fopen('../../model/liste des anciens bacheliers.xls', 'w');
        fputs($liste, utf8_decode("N°\tNom et prénoms\tDate de naissance\tLieu de naissance\tNationalité\tEtablissement\tContact\tE-mail\tUE\tDiplome\tAnnée du diplome\tValidation des études supérieurs\tProfession\tCours\tNom et prénoms du parent\tContact du parent\tE-mail du parent\tAdresse du parent\n"));
        $i = 0;
        foreach ($candidats_admis as $candidat) {
            $i++;
            fputs($liste, utf8_decode("$i\t" . $candidat["nom"] . " " . $candidat["prenom"] . "\t" . $candidat["datenaiss"] . "\t" . $candidat["lieunaiss"] . "\t" . $candidat["nationalite"] . "\t" . $candidat["etablissementorg"] . "\t" . $candidat["tel"] . "\t" . $candidat["email"] . "\t" . $candidat["ue"] . "\t" . $candidat["diplome"] . "\t" . $candidat["anneediplome"] . "\t" . $candidat["ves"] . "\t" . $candidat["profession"] . "\t" . $candidat["cours"] . "\t" . $candidat["nomparent"] . " " . $candidat["prenomparent"] . "\t" . $candidat["telparent"] . "\t" . $candidat["emailparent"] . "\t" . $candidat["adresseparent"] . "\n"));
        }
    }
}

