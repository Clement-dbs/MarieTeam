<?php

if(!isset($_SESSION)) session_start();  

if(isset($_POST['secteur'])){
    $_SESSION['secteur'] = $_POST['secteur'];
}

if(isset($_POST['liaison'])){
    $_SESSION['liaison'] = $_POST['liaison'];
}

/*if(isset($_POST['periode'])){
    $_SESSION['periode'] = $_POST['periode'];
    var_dump($_SESSION['periode']);
}*/

if (isset($_POST['dateDepart'])) {
    $_SESSION['dateDepart'] = $_POST['dateDepart'];
}

if(isset($_POST['traversee'])){
    $_SESSION['traversee'] = $_POST['traversee'];
}

if(isset($_POST['bateauID'])){
    $_SESSION['bateauID'] = $_POST['bateauID'];
}
?>