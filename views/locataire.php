<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Locataires</title>
        <?php include_once ("../includes/links.php"); ?>
        <script src="../fichierJs/structure.js" defer></script>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeLocataires.php")?>

        <section class="sectionProprietaire">
            <section class="headerProprietaire">
                <div>
                    <!-- <button id="printBtnL">Imprimer</button> -->
                </div>

                <div>
                    <button class="btnAjouter">Ajouter Locataire</button>
                </div>
            </section>
            
            <section class="frameCreation">
                <section class="sectionCreation">
                    <form method="POST" action="../controlleurs/enregistrerLocataire.php" enctype="multipart/form-data">
                        <div class="headerForm">
                           <h1>AJOUTER LOCATAIRE</h1>
                        </div>
                        
                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for="numLocataire">Numéro du Locataire</label> <br>
                                <input type="number" name="numLocataire" class="champEntree" required/> <br><br>

                                <label for="nomLocataire">Nom</label> <br>
                                <input type="text" name="nomLocataire" class="champEntree" required/> <br><br>

                                <label for="prenomLocataire">Prénom</label> <br>
                                <input type="text" name="prenomLocataire" class="champEntree" required/> <br><br>

                                <label for="adresse1Locataire">Adresse 1</label> <br>
                                <input type="text" name="adresse1Locataire" class="champEntree" required/> <br><br>

                                <label for="adresse2Locataire">Adresse 2</label> <br>
                                <input type="text" name="adresse2Locataire" class="champEntree" required/> <br><br>

                                <label for="codePostalLocataire">Code Postal</label> <br>
                                <input type="text" name="codePostalLocataire" class="champEntree" required/> <br><br>
                            </div>

                            <div class="divInputsII">
                                <label for="villeLocataire">Ville</label> <br>
                                <input type="text" name="villeLocataire" class="champEntree" required/> <br><br>

                                <label for="numTel1Locataire">Numéro Téléphone 1</label> <br>
                                <input type="text" name="numTel1Locataire" class="champEntree" required/> <br><br>

                                <label for="numTel2Locataire">Numéro Téléphone 2</label> <br>
                                <input type="text" name="numTel2Locataire" class="champEntree" required/> <br><br>

                                <label for="email">Email</label> <br>
                                <input type="text" name="email" class="champEntree" required/> <br><br>

                                <label for="photo">Photo</label> <br>
                                <input type="file" name="photo" class="champPhoto" required/><br><br>
                            </div>
                        </div>

                        <div class="divCancel"> 
                            <button class="btnCancel">Cancel</button>
                            <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                        </div>
                    </form>
                </section>
            </section>
            
            <section class="sectionAffiche">
                <?php 
                    $locataires = getListelocataires();
                    if(count($locataires) > 0) {
                        for ($i = 0; $i < count($locataires); $i++)  {
                            echo "<section class=\"afficheLocataire\"> 
                                <div class=\"profil\">
                                    <img src='../images/locataire/".$locataires[$i]->getPhoto()."' class=\"imgLocataire\"/>

                                    <div class=\"nomPrenomEmail\">
                                        <strong>".$locataires[$i]->getNomLocataire()." ".$locataires[$i]->getPrenomLocataire()."</strong><br>
                                        <span>".$locataires[$i]->getEmail()." </span> 
                                    </div>
                                </div>

                                <div class=\"information\">
                                    <div class=\"infoTypeI\">
                                        <h4>Contacts</h4>
                                        ".$locataires[$i]->getNumTel1Locataire()."<br>
                                        ".$locataires[$i]->getNumTel2Locataire()."
                                    </div>

                                    <div class=\"infoTypeII\">
                                        <h4>Adresses</h4>
                                        I : ".$locataires[$i]->getAdresse1Locataire()."<br>
                                        II : ".$locataires[$i]->getAdresse2Locataire()."
                                    </div>

                                    <div class=\"infoTypeIII\">
                                        <h4>Ville</h4>
                                        ".$locataires[$i]->getVilleLocataire()."<br>
                                    </div>
                                </div>

                                <div class=\"num\">
                                    ".$locataires[$i]->getNumLocataire()."
                                </div>
                            
                            </section>";
                        }
                    }

                    else {
                        echo "<div class = \"affichePardefaut\"> 
                                <i class=\"fa-regular fa-hourglass\"></i> Désoler, il n'ya des Locataires enregistrés
                            </div>";
                    }
                ?>
            </section>
        </section>
    </body>
</html>