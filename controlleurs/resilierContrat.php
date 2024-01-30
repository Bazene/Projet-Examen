<?php
    include_once ("../configuration/config.php");
    include_once ("../models/contrat.php");
    include_once ("getListeContrats.php");

    $idContrat = $_POST['idContrat'];
    $contrats = getListeContrats();

    foreach ($contrats as $contrat) {
        if(($contrat->getIdContrat($contrat)) == $idContrat) {
            
            if($contrat->resilierContrat($contrat)) {
                header("Location:../views/resilierContrat.php");
            }
        }
    }