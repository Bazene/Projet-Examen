<?php
    include_once ("../configuration/config.php");
    include_once ("../models/appartement.php");

    $idProprietaire = intval($_POST['idProprietaire']);
    $idTarif = intval($_POST['idTarif']);
    $numLocation = intval($_POST['numLocation']);
    $categorie = $_POST['categorie'];
    $typeAppartement = $_POST['typeAppartement'];
    $nbPersonnes = intval($_POST['nbPersonnes']);
    $adresseLocation = $_POST['adresseLocation'];
    $equipements = $_POST['equipements'];
    $disponibilite = 1;

    $photo = $_FILES['photo'];
    
    // we verify the size of the picture
    if($photo['size']<=7000000) {
        $allowdExtentions = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
        $fileInfo = pathinfo($photo['name']);
        $extension = $fileInfo['extension'];

        // we verify if the extension is allowed
        if(in_array($extension, $allowdExtentions)) {
            $tempFolder = $photo['tmp_name'];
            $fileName = basename($photo['name']);
            $destinationFolder = '../images/'.$fileName;
            
            // we verify if the picture is moved in the destination file
            if(move_uploaded_file($tempFolder, $destinationFolder)) {
                $appartement = new Appartement($idProprietaire, $idTarif, $numLocation, $categorie, $typeAppartement, $nbPersonnes, $adresseLocation, $fileName, $equipements, $disponibilite);
                if($appartement->enregistrerAppartement()) {
                    header("Location:../views/appartement.php");
                }
            } else echo "l'image n'est pas téléchargée";

        } else echo 'le type de l\'image n\'est pas prise en charge';

    } else echo "le fichier est trop large";
