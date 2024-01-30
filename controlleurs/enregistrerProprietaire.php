<?php

try {
    include_once ("../configuration/config.php");
    include_once ("../models/proprietaire.php");
    
    $numProprietaire = intval($_POST['numProprietaire']) ;
    $nomProprietaire = $_POST['nomProprietaire'] ;
    $prenomProprietaire = $_POST['prenomProprietaire'] ;
    $adresse1Proprietaire = $_POST['adresse1Proprietaire'] ;
    $adresse2Proprietaire = $_POST['adresse2Proprietaire'] ;
    $codePostalProprietaire = $_POST['codePostalProprietaire'] ;
    $villeProprietaire = $_POST['villeProprietaire'] ;
    $numTel1Proprietaire = $_POST['numTel1Proprietaire'] ;
    $numTel2Proprietaire = $_POST['numTel2Proprietaire'] ;
    $CAcumule = intval($_POST['CAcumule']) ;
    $email = $_POST['email'] ;

    $photo = $_FILES['photo'];

    // we verify the size of the picture
    if($photo['size']<=10000000) {
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
                $proprietaire = new Proprietaire($numProprietaire, $nomProprietaire, $prenomProprietaire, $adresse1Proprietaire, $adresse2Proprietaire, $codePostalProprietaire, $villeProprietaire, $numTel1Proprietaire, $numTel2Proprietaire, $CAcumule, $email, $fileName);
                if($proprietaire->enregistrerProprietaire()) {
                    header("Location:../views/proprietaire.php");
                }
            } else echo "l'image n'est pas téléchargée";

        } else echo 'le type de l\'image n\'est pas prise en charge';

    } else echo "le fichier est trop large";

} catch (Exception $e) {
    $e->getMessage();
}