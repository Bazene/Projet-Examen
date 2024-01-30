<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Locataire</title>
        <?php include_once ("../includes/links.php"); ?>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeLocataires.php"); ?>

        <section class="sectionCreationAffichage">
            <h1>ENREGISTREMENT D'UN LOCATAIRE</h1>

            <section class="sectionCreation">
                <form method="POST" action="../controlleurs/enregistrerLocataire.php"> 
                    <h3>Veillez saisir les différents parametres</h3>

                    <div class="divInputs">
                        <div class="divInputsI">
                            <label for="numLocataire">Numéro Locataire</label> <br>
                            <input type="number" name="numLocataire" class="champEntree"/> <br><br>

                            <label for="nomLocataire">Nom</label> <br>
                            <input type="text" name="nomLocataire" class="champEntree"/> <br><br>

                            <label for="prenomLocataire">Prénom</label> <br>
                            <input type="text" name="prenomLocataire" class="champEntree"/> <br><br>

                            <label for="adresse1Locataire">Adresse 1</label> <br>
                            <input type="text" name="adresse1Locataire" class="champEntree"/> <br><br>

                            <label for="adresse2Locataire">Adresse 2</label> <br>
                            <input type="text" name="adresse2Locataire" class="champEntree"/> <br><br>

                            <label for="codePostalLocataire">Code Postal</label> <br>
                            <input type="text" name="codePostalLocataire" class="champEntree"/> <br><br>
                        </div>

                        <div class="divInputsII">
                            <label for="villeLocataire">Ville</label> <br>
                            <input type="text" name="villeLocataire" class="champEntree"/> <br><br>

                            <label for="numTel1Locataire">Numéro Téléphone 1</label> <br>
                            <input type="text" name="numTel1Locataire" class="champEntree"/> <br><br>

                            <label for="numTel2Locataire">Numéro Téléphone 2</label> <br>
                            <input type="text" name="numTel2Locataire" class="champEntree"/> <br><br>

                            <label for="email">Email</label> <br>
                            <input type="text" name="email" class="champEntree"/> <br><br>
                        </div>
                    </div>

                    <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                </form>
            </section>

            <section class="sectionAffichage">
                <h1>LES LOCATAIRES</h1>

                <table class="affichageDonneesDb">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nom et Post-nom</th>
                            <th>Adresse 1</th>
                            <th>Adresse 2</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Num Télé 1</th>
                            <th>Num Télé 2</th>
                            <th>Adresse mail</th>
                        </tr>
                    </thead>

                    <?php
                    $Locataires = getListeLocataires();
                    for ($i = 0; $i < count($Locataires); $i++)  {
                        echo "<tr>";
                        echo "<th>" .$Locataires[$i]->getNumLocataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getNomLocataire()." ".$Locataires[$i]->getPrenomLocataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getAdresse1Locataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getAdresse2Locataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getCodePostalLocataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getVilleLocataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getNumTel1Locataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getNumTel2Locataire()."</th>";
                        echo "<th>" .$Locataires[$i]->getEmail()."</th>";
                        echo "</tr>";
                    }            
                    ?>
                </table>
            </section>
        </section>
    </body>
</html>