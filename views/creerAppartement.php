<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appartement</title>
        <?php include_once ("../includes/links.php"); ?>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeTarifs.php"); ?>
        <?php include_once ("../controlleurs/getListeProprietaires.php") ?>
        <?php include_once ("../controlleurs/getListeAppartements.php"); ?>

        <section class="sectionCreationAffichage">
            <h1>ENREGISTREMENT D'UN APPARTEMENT</h1>

            <section class="sectionCreation">
                <form id="formulaireChangerMdp" method="POST" action="../controlleurs/enregistrerAppartement.php" enctype='multipart/form-data'>
                    <h3>Veillez saisir les différents parametres</h3>

                    <div class="divInputs">
                        <div class="divInputsI">
                            
                            <label for="numLocation">Numéro Location</label> <br>
                            <input type="number" name="numLocation" class="champEntree"/> <br><br>
                            
                            <label for="categorie">Catégorie</label> <br>
                            <input type="text" name="categorie" class="champEntree"/> <br><br>

                            <label for="typeAppartement">Type</label> <br>
                            <input type="text" name="typeAppartement" class="champEntree"/> <br><br>

                            <label for="nbPersonnes">Nombre personnes</label> <br>
                            <input type="text" name="nbPersonnes" class="champEntree"/> <br><br>
                            
                            <label for="idTarif">Tarif</label> <br>
                            <select name = "idTarif" class="champSelect">
                                <option value="">Choisi un tarif</option>
                                <?php 
                                    foreach(($tarifs = getListeTarifs()) as $tarif) {
                                        echo "<option value = ".$tarif->getIdTarif($tarif).">".$tarif->getIdTarif($tarif).". HS:".$tarif->getPrixSemHS()."/ BS".$tarif->getPrixSemHS()."</option>";
                                    }
                                ?>
                            </select><br><br>
                        </div>

                        <div class="divInputsII">
                            <label for="adresseLocation">Adresse Location</label> <br>
                            <input type="text" name="adresseLocation" class="champEntree"/> <br><br>
                            
                            <label for="photo">Photo</label> <br>
                            <input type="file" name="photo" class="champEntree" required/><br><br>

                            <label for="equipements">Equipements</label> <br>
                            <input type="text" name="equipements" class="champEntree"/><br><br>
                        
                            <label for="idProprietaire">Proprietaire</label> <br>
                            <select name = "idProprietaire" class="champSelect">
                                <option value="">Choisi un proprietaire</option>
                                <?php
                                    foreach(($proprietaires = getListeProprietaires()) as $proprietaire) {
                                        echo "<option value = ".$proprietaire->getIdProprietaire($proprietaire).">".$proprietaire->getNomProprietaire()." ".$proprietaire->getPrenomProprietaire()."</option>" ;
                                    }
                                ?>
                            </select><br><br>
                        </div>
                    </div>
                    
                    <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                </form>
            </section>

            <section class="sectionAffichage">
                <h1>LES APPARTEMENTS</h1>

                <table class="affichageDonneesDb">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Type</th>
                            <th>Catégorie</th>
                            <th>Nb personnes</th>
                            <th>Adresse</th>
                            <th>Photo</th>
                            <th>Equipements</th>
                            <th>Proprietaire</th>
                            <th>Tarif</th>
                        </tr>
                    </thead>

                    <?php
                        $appartements = getListeAppartements();

                        for ($i = 0; $i < count($appartements); $i++)  {
                            echo "<tr>";
                            echo "<th>" .$appartements[$i]->getNumLocation()."</td>";
                            echo "<th>" .$appartements[$i]->getTypeAppartement()."</th>";
                            echo "<td>" .$appartements[$i]->getCategorie()."</td>";
                            echo "<td>" .$appartements[$i]->getNbPersonnes()."</td>";
                            echo "<td>" .$appartements[$i]->getAdresseLocation()."</td>";
                            echo "<td> <img src='../images/".$appartements[$i]->getPhoto()."'></td>";
                            echo "<td>" .$appartements[$i]->getEquipements()."</td>";
                            echo "<td>" .$appartements[$i]->getIdProprietaire()."</td>";
                            echo "<td>" .$appartements[$i]->getIdTarif()."</td>";
                            echo "</tr>";
                        }            
                    ?>
                </table>
            </section>
        </section>
    </body>
</html>