<?php
    session_start();

    if($_POST['idContrat']) {
        $idContrat = $_POST['idContrat'];

        if(!empty($idContrat)) {
            $_SESSION['idContrat'] = $idContrat;
            header("Location:../views/modifierContrat.php");
        }
    }