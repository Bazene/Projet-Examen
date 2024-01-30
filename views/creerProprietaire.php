<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer Proprietaire</title>
        <?php include_once ("../includes/links.php"); ?>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeProprietaires.php")?>

        <section class="sectionCreationAffichage">
            <h1>ENREGISTREMENT D'UN PROPRIETAIRE</h1>

            <section class="sectionCreation">
                <form method="POST" action="../controlleurs/enregistrerProprietaire.php" enctype="multipart/form-data">
                    <h3>Veillez saisir les différents parametres</h3>

                    <div class="divInputs">
                        <div class="divInputsI">
                            <label for="numProprietaire">Numéro du Proprietaire</label> <br>
                            <input type="number" name="numProprietaire" class="champEntree"/> <br><br>

                            <label for="nomProprietaire">Nom</label> <br>
                            <input type="text" name="nomProprietaire" class="champEntree"/> <br><br>

                            <label for="prenomProprietaire">Prénom</label> <br>
                            <input type="text" name="prenomProprietaire" class="champEntree"/> <br><br>

                            <label for="adresse1Proprietaire">Adresse 1</label> <br>
                            <input type="text" name="adresse1Proprietaire" class="champEntree"/> <br><br>

                            <label for="adresse2Proprietaire">Adresse 2</label> <br>
                            <input type="text" name="adresse2Proprietaire" class="champEntree"/> <br><br>

                            <label for="codePostalProprietaire">Code Postal</label> <br>
                            <input type="text" name="codePostalProprietaire" class="champEntree"/> <br><br>
                        </div>

                        <div class="divInputsII">
                            <label for="villeProprietaire">Ville</label> <br>
                            <input type="text" name="villeProprietaire" class="champEntree"/> <br><br>

                            <label for="numTel1Proprietaire">Numéro Téléphone 1</label> <br>
                            <input type="text" name="numTel1Proprietaire" class="champEntree"/> <br><br>

                            <label for="numTel2Proprietaire">Numéro Téléphone 2</label> <br>
                            <input type="text" name="numTel2Proprietaire" class="champEntree"/> <br><br>

                            <label for="CAcumule">CA Cumulé</label> <br>
                            <input type="number" name="CAcumule" class="champEntree"/> <br><br>

                            <label for="email">Email</label> <br>
                            <input type="text" name="email" class="champEntree"/> <br><br>

                            <label for="photo">Photo</label> <br>
                            <input type="file" name="photo" class="champEntree" required/><br><br>
                        </div>
                    </div>

                    <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                </form>
            </section>

            <section class="sectionAffichage">
                <h1>LES PROPRIETAIRES</h1>

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
                            <th>CA cumulé</th>
                            <th>Adresse mail</th>
                            <th>Photo</th>
                        </tr>
                    </thead>

                    <?php
                    $proprietaires = getListeProprietaires();
                    for ($i = 0; $i < count($proprietaires); $i++)  {
                        echo "<tr>";
                        echo "<th>" .$proprietaires[$i]->getNumProprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getNomProprietaire()." ".$proprietaires[$i]->getPrenomProprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getAdresse1Proprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getAdresse2Proprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getCodePostalProprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getVilleProprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getNumTel1Proprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getNumTel2Proprietaire()."</th>";
                        echo "<th>" .$proprietaires[$i]->getCAcumule()."</th>";
                        echo "<th>" .$proprietaires[$i]->getEmail()."</th>";
                        echo "<th> <img src='../images/".$proprietaires[$i]->getPhoto()."'></th>";
                        echo "</tr>";
                    }            
                    ?>
                </table>
            </section>
        </section>
    </body>
</html>