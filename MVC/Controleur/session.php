<?php

if(!isset($_SESSION)) session_start();  

if(isset($_POST['secteur'])){
    $_SESSION['secteur'] = $_POST['secteur'];
}

if(isset($_POST['liaison'])){
    $_SESSION['liaison'] = $_POST['liaison'];
    $codeLiaison = $_SESSION['liaison'];
}

if(isset($_POST['bateauID'])){
    $_SESSION['bateauID'] = $_POST['bateauID'];
}

if (isset($_POST['dateDepart'])) {
    $_SESSION['dateDepart'] = $_POST['dateDepart'];
}

if(isset($_POST['traversee'])){
    $_SESSION['traversee'] = $_POST['traversee'];
    $codeLiaison = $_SESSION['liaison'];
}

if (isset($_SESSION['dateDepart'])) {
    $idPeriode = getIdPeriodeByDateDepart($_SESSION['dateDepart']);

    if ($idPeriode !== null) {
        $_SESSION['idPeriode'] = $idPeriode;
    } else {
       // echo "Aucune periode trouvée pour cette date de départ.";
    }
}
?>
