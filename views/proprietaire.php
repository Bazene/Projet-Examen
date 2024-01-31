<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proprietaires</title>
        <?php include_once ("../includes/links.php"); ?>
        <script src="../fichierJs/structure.js" defer></script>
        <script src="../fichierJs/proprietaire.js" defer></script>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeProprietaires.php")?>

        <section class="sectionProprietaire">
            <section class="headerProprietaire">
                <div>
                    <button id="printBtn">Imprimer</button>
                </div>

                <div>
                    <button class="btnAjouter">Ajouter Proprietaire</button>
                </div>

                <div id="listeProp">
                    Liste des proprietaires
                </div>
            </section>
            
            <section class="frameCreation">
                <section class="sectionCreation">
                    <form method="POST" action="../controlleurs/enregistrerProprietaire.php" enctype="multipart/form-data">
                        <div class="headerForm">
                           <h1>AJOUTER PROPRIETAIRE</h1>
                        </div>
                        
                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for="numProprietaire">Numéro du Proprietaire</label> <br>
                                <input type="number" name="numProprietaire" class="champEntree" required/> <br><br>

                                <label for="nomProprietaire">Nom</label> <br>
                                <input type="text" name="nomProprietaire" class="champEntree" required/> <br><br>

                                <label for="prenomProprietaire">Prénom</label> <br>
                                <input type="text" name="prenomProprietaire" class="champEntree" required/> <br><br>

                                <label for="adresse1Proprietaire">Adresse 1</label> <br>
                                <input type="text" name="adresse1Proprietaire" class="champEntree" required/> <br><br>

                                <label for="adresse2Proprietaire">Adresse 2</label> <br>
                                <input type="text" name="adresse2Proprietaire" class="champEntree" required/> <br><br>

                                <label for="codePostalProprietaire">Code Postal</label> <br>
                                <input type="text" name="codePostalProprietaire" class="champEntree" required/> <br><br>
                            </div>

                            <div class="divInputsII">
                                <label for="villeProprietaire">Ville</label> <br>
                                <input type="text" name="villeProprietaire" class="champEntree" required/> <br><br>

                                <label for="numTel1Proprietaire">Numéro Téléphone 1</label> <br>
                                <input type="text" name="numTel1Proprietaire" class="champEntree" required/> <br><br>

                                <label for="numTel2Proprietaire">Numéro Téléphone 2</label> <br>
                                <input type="text" name="numTel2Proprietaire" class="champEntree" required/> <br><br>

                                <label for="CAcumule">CA Cumulé</label> <br>
                                <input type="number" name="CAcumule" class="champEntree" required/> <br><br>

                                <label for="email">Email</label> <br>
                                <input type="text" name="email" class="champEntree" required/> <br><br>

                                <label for="photo">Photo</label> <br>
                                <input type="file" name="photo" class="champPhoto" required/><br><br>
                            </div>
                        </div>

                        <div class="divCancel"> 
                            <button type="button" class="btnCancel">Cancel</button>
                            <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                        </div>
                    </form>
                </section>
            </section>
            
            <section class="sectionAffiche">
                <?php 
                    $proprietaires = getListeProprietaires();

                    if(count($proprietaires) > 0) {
                        for ($i = 0; $i < count($proprietaires); $i++)  {
                            echo 
                            "<section class=\"afficheProprietaire\"> 
                                <div class=\"profil\">
                                    <img src='../images/".$proprietaires[$i]->getPhoto()."' class=\"imgProprietaire\"/>

                                    <div class=\"nomPrenomEmail\">
                                        <strong>".$proprietaires[$i]->getNomProprietaire()." ".$proprietaires[$i]->getPrenomProprietaire()."</strong><br>
                                        <span>".$proprietaires[$i]->getEmail()." </span> 
                                    </div>
                                </div>

                                <div class=\"information\">
                                    <div class=\"infoTypeI\">
                                        <h4>Contacts</h4>
                                        ".$proprietaires[$i]->getNumTel1Proprietaire()."<br>
                                        ".$proprietaires[$i]->getNumTel2Proprietaire()."
                                        
                                    </div>

                                    <div class=\"infoTypeII\">
                                        <h4>Adresses</h4>
                                        <ul>
                                            <li>".$proprietaires[$i]->getAdresse1Proprietaire()."</li>
                                            <li>".$proprietaires[$i]->getAdresse2Proprietaire()."</li>
                                        </ul>
                                    </div>

                                    <div class=\"infoTypeIII\">
                                        <h4>Ville</h4>
                                        ".$proprietaires[$i]->getVilleProprietaire()."<br>
                                    </div>
                                </div>

                                <div class=\"num\">
                                    ".$proprietaires[$i]->getNumProprietaire()."
                                </div>
                            
                            </section>";
                        }
                    }

                    else {
                        echo "<div class = \"affichePardefaut\"> 
                                <i class=\"fa-regular fa-hourglass\"></i> Désoler, il n'y a pas des Proprietaires enregistrés
                            </div>";
                    }
                ?>
            </section>
        </section>
    </body>
</html>