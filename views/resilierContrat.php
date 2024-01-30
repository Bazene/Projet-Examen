<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Résilier Contrat</title>
        <?php include_once ("../includes/links.php"); ?>
        <link rel="stylesheet" href="../style/resilierContrat.css"/>
        <link rel="stylesheet" href="../style/passerContrat.css"/>
        <script src="../fichierJs/structure.js" defer></script>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeLocataires.php"); ?>
        <?php include_once ("../controlleurs/getListeAppartements.php"); ?>
        <?php include_once ("../controlleurs/getListeContrats.php"); ?>

        <section class="sectionCreationAffichage">
            <section class="headerProprietaire">
                <div>
                    <button class="btnAjouter">Resilier Contrat</button>
                </div>
            </section>

            <section class="frameCreation">
                <section class="sectionCreation" style="margin-top:150px">
                    <form method="POST" action="../controlleurs/resilierContrat.php"> 
                        <div class="headerForm">
                            <h1>RESILIER CONTRAT</h1>
                        </div>

                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for = "idContrat">Contrat</label> <br>
                                <select name = "idContrat" class="champSelect">
                                    <option value="">Choisi le contrat à resilier</option>
                                    <?php
                                        if(!empty(getListeContrats())) {
                                            foreach(($contrats = getListeContrats()) as $contrat) {
                                                if(($contrat->getEtat()) == 'encours') {
                                                    echo "<option value = ".$contrat->getIdContrat($contrat).">".$contrat->getIdContrat($contrat).". ".$contrat->getDateCreation()."/ APP : ".$contrat->getIdAppartement().". ".$contrat->getCategorieAppartement()."/".$contrat->getTypeAppartement()." / LOC : ".$contrat->getIdentiteLocataire(1)." ".$contrat->getIdentiteLocataire(2)."</option>" ;
                                                }
                                            }
                                        }
                                        else {
                                            echo "<option value = \"\">Il n'ya pas de contrat trouver</option>" ;
                                        }
                                    ?>
                                </select><br><br>
                            </div>

                            <div class="divInputsII">
                                
                            </div>
                        </div>
                        
                        <div class="divCancel">
                            <button type="button" class="btnCancel">Cancel</button>

                            <input type="submit" class="btnSubmit" value="Resilier contrat"/> <br>
                        </div>
                    </form>
                </section>
            </section>
            
            <section class="sectionAffiche">
                <?php 
                    $contrats = getListeContrats();
                ?>

                <?php if(count($contrats) > 0):?>
                    <section class="afficheContrat">
                        <?php
                            for ($i = 0; $i < count($contrats); $i++)  {
                                if($contrats[$i]->getEtat() == "resilier") {
                                    echo 
                                    "<section class=\"infoGeneralContrat\">
                                        <div class=\"nomContrat\">
                                            <h1>CONTRAT TYPE DE LOCATION OU DE COLOCATION</h1>
                                        </div>

                                        <div class=\"sousTitre\">
                                            <h1><strong>DESIGNATION DES PARTIES</strong></h1>
                                        </div>

                                        <div class=\"informationContrat\">
                                            Le présent contrat est conclu entre les sousignés: <br>
                                            <div class=\"infoBL\"> <br>
                                                <h4>Le locataire</h4>
                                                <ul>
                                                    <li>Nom et prénom du Locataire : <strong>".$contrats[$i]->getIdentiteLocataire(1)." ".$contrats[$i]->getIdentiteLocataire(2)."</strong></li>
                                                    <li>Adresse 1 & 2 : <strong>".$contrats[$i]->getIdentiteLocataire(6)." & ".$contrats[$i]->getIdentiteLocataire(7)."</strong></li>
                                                    <li>Adresse mail : <strong>".$contrats[$i]->getIdentiteLocataire(3)."</strong></li>
                                                </ul><br><br>
                                                
                                                <h4> Informations liées au contrat</h4>
                                                <ul>
                                                    <li>Num contrat : <strong style=\"color:#87BBEE;\">".$contrats[$i]->getNumContrat()."</strong></li>
                                                    <li>Créer en : ".$contrats[$i]->getDateCreation()."</li>
                                                    <li>Début contrat : ".$contrats[$i]->getDateDebut()."</li>
                                                    <li>Fin contrat : <strong style=\"color:red;\">".$contrats[$i]->getDateFin()."</strong></li>
                                                    <li><i class=\"fa-regular fa-bell\"></i> <strong style = \"color:#87BBEE;\">  ".$contrats[$i]->getEtat()."</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>";
                                }

                            
                            }
                        ?>
                    </section>
                
                <?php else :?>
                    <?php
                        echo "<div class = \"affichePardefaut\"> 
                                <i class=\"fa-regular fa-hourglass\"></i> Désoler, aucun contrat n'est enregistré
                            </div>";
                    ?>
                <?php endif ?>
            </section>
        </section>
    </body>
</html>