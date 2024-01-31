<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tarif</title>
        <?php include_once ("../includes/links.php"); ?>
        <link rel="stylesheet" href="../style/tarif.css" />
        <script src="../fichierJs/structure.js" defer></script>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeTarifs.php")?>

        <section class="sectionProprietaire">
            <section class="headerProprietaire">
                <div>
                    <!-- <button id="printBtnA">Imprimer</button> -->
                </div>

                <div>
                    <button class="btnAjouter">Créer Tarif</button>
                </div>
            </section>
            
            <section class = "frameCreation">
                <section class="sectionCreation">
                    <form method="POST" action="../controlleurs/enregistrerTarif.php"> 
                        <div class="headerForm">
                        <h1>CREER TARIF</h1>
                        </div>
                        
                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for="codeTarif">Code Tarif</label> <br>
                                <input type="text" name="codeTarif" class="champEntree" required/> <br><br>

                                <label for="prixSemHS">Prix Sem HS</label> <br>
                                <input type="number" name="prixSemHS" class="champEntree" required/> <br><br>

                                <label for="prixSemBS">Prix Sem BS</label> <br>
                                <input type="number" name="prixSemBS" class="champEntree" required/> <br><br>
                            </div>
                        </div>

                        <div class="divCancel"> 
                            <button type="button" class="btnCancel">Cancel</button>

                            <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                        </div>
                    </form>
                </section>
            </section>
            
            <section class="">
                <?php
                    $tarifs = getListeTarifs();
                ?>

                <?php if(isset($tarifs)) : ?>
                    <section class="afficheTarif">
                       <?php 
                            for ($i = 0; $i < count($tarifs); $i++) {
                                echo 
                                    "<div class=\"divCodePrix\">
                                        <div class=\"codeTarif\">
                                            code Tarif : " .$tarifs[$i]->getCodeTarif()."
                                        </div>

                                        <div class=\"prix\">
                                            Prix HS : $ ".$tarifs[$i]->getPrixSemHS()." <br>
                                            Prix BS : $ ".$tarifs[$i]->getPrixSemBS()." 
                                        </div>
                                    </div>";
                            }
                        ?>
                    </section>

                    <?php else: ?>
                        <?php
                            echo "<div class = \"affichePardefaut\"> 
                                    <i class=\"fa-regular fa-hourglass\"></i> Désoler, il y a pas des tarifs enregistrés
                                </div>";
                        ?>
                <?php endif ?>
            </section>
    </body>
</html>