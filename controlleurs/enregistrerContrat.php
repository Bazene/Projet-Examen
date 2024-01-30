<?php
    session_start();

    include_once ("../configuration/config.php");
    include_once ("../models/contrat.php");

    $numContrat = $_POST['numContrat'];
    $etat = $_POST['etat'];
    $dateCreation = $_POST['dateCreation'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $idAppartement = $_POST['idAppartement'];
    $idLocataire = $_POST['idLocataire'];

    $contrat = new Contrat($numContrat, $etat, $dateCreation, $dateDebut, $dateFin, $idAppartement, $idLocataire);

    // $appartemet = $_POST['Objetappartement'] ;
    $appartemet = $_SESSION['appartemet'] ; // on recupère l'objet appartement dans la session
    $disponibilite = 0; // on change la disponibilite de l'appartement
    

    if($contrat->enregistrerContrat()) {
        // if($appartemet->modifierDisponibilite($appartemet, 0)) {
            header("Location:../views/passerContrat.php");
        // }
    }