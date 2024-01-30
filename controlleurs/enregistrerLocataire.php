<?php

try {
    include_once ("../configuration/config.php");
    include_once ("../models/Locataire.php");
    
    $numLocataire = $_POST['numLocataire'] ;
    $nomLocataire = $_POST['nomLocataire'] ;
    $prenomLocataire = $_POST['prenomLocataire'] ;
    $adresse1Locataire = $_POST['adresse1Locataire'] ;
    $adresse2Locataire = $_POST['adresse2Locataire'] ;
    $codePostalLocataire = $_POST['codePostalLocataire'] ;
    $villeLocataire = $_POST['villeLocataire'] ;
    $numTel1Locataire = $_POST['numTel1Locataire'] ;
    $numTel2Locataire = $_POST['numTel2Locataire'] ;
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
            $destinationFolder = '../images/locataire/'.$fileName;
            
            // we verify if the picture is moved in the destination file
            if(move_uploaded_file($tempFolder, $destinationFolder)) {
                $locataire = new locataire($numLocataire, $nomLocataire, $prenomLocataire, $adresse1Locataire, $adresse2Locataire, $codePostalLocataire, $villeLocataire, $numTel1Locataire, $numTel2Locataire, $email, $fileName);
                if($locataire->enregistrerlocataire()) {
                    header("Location:../views/locataire.php");
                }
            } else echo "l'image n'est pas téléchargée";

        } else echo 'le type de l\'image n\'est pas prise en charge';

    } else echo "le fichier est trop large";
    
} catch (Exception $e) {
    $e->getMessage();
}