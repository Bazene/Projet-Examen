<?php
    include_once ("../configuration/config.php");
    include_once ("../models/tarif.php");

    $codeTarif = $_POST['codeTarif'];
    $prixSemHS = $_POST['prixSemHS'];
    $prixSemBS = $_POST['prixSemBS'];

    $tarif = new Tarif($codeTarif, $prixSemHS, $prixSemBS);

    if($tarif->enregistrerTarif()){
        header("Location:../views/tarif.php");
    }