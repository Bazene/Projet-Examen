<?php
    session_start();

    include_once ("../configuration/config.php");
    include_once ("../models/contrat.php");

    if(isset($_POST['enregistrer'])) {
        $etat = $_POST['etat'];
        $idLocataire = intval($_POST['idLocataire']);
        $idAppartement = intval($_POST['idAppartement']);
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $dateCreation = $_POST['dateCreation'];
        $numContrat = intval($_POST['numContrat']);
        
        $contrat = new Contrat($numContrat, $etat, $dateCreation, $dateDebut, $dateFin, $idAppartement, $idLocataire);

        if(isset($contrat)) {
            if(Contrat::modifierContrat($contrat)) {
                unset($_SESSION['idContrat']);
                header("Location:../views/modifierContrat.php");
            }
        }
    }