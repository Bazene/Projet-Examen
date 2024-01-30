<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tarif</title>
        <?php include_once ("../includes/links.php"); ?>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeTarifs.php")?>

        <section class="sectionCreationAffichage">
            <h1>ENREGISTREMENT D'UN TARIF</h1>

            <section class="sectionCreation">
                <form method="POST" action="../controlleurs/enregistrerTarif.php"> 
                    <h3>Veillez saisir les différents parametres</h3>

                    <div class="divInputs">
                        <div class="divInputsI">
                            <label for="codeTarif">Code Tarif</label> <br>
                            <input type="text" name="codeTarif" class="champEntree"/> <br><br>

                            <label for="prixSemHS">Prix Sem HS</label> <br>
                            <input type="number" name="prixSemHS" class="champEntree"/> <br><br>

                            <label for="prixSemBS">Prix Sem BS</label> <br>
                            <input type="number" name="prixSemBS" class="champEntree"/> <br><br>

                        </div>

                        <div class="divInputsII">
                        </div>
                    </div>

                    <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                </form>
            </section>

            <section class="sectionAffichage">
                <h1>LES TARIFS</h1>

                <table class="affichageDonneesDb">
                    <thead>
                        <tr>
                            <th>Code Tarif</th>
                            <th>Prix Sem HS</th>
                            <th>Prix Sem BS</th>
                        </tr>
                    </thead>

                    <?php
                    $tarifs = getListeTarifs();
                    for ($i = 0; $i < count($tarifs); $i++)  {
                        echo "<tr>";
                        echo "<th>" .$tarifs[$i]->getCodeTarif()."</th>";
                        echo "<th>" .$tarifs[$i]->getPrixSemHS()."</th>";
                        echo "<th>" .$tarifs[$i]->getPrixSemBS()."</th>";
                        echo "</tr>";
                    }            
                    ?>
                </table>
            </section>
        </section>
    </body>
</html>