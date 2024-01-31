<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier Contrat</title>
        <?php include_once ("../includes/links.php"); ?>
        <link rel="stylesheet" href="../style/modifierContrat.css"/>
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
                    <!-- <button id="printBtnE">Imprimer</button> -->
                </div>

                <div>
                    <a href="#frameC"><button class="btnAjouter">Modifier Contrat</button></a>
                </div>
            </section>
            
            <section class="sectionAffiche">
                <?php 
                    $contrats = getListeContrats();
                ?>

                <?php if(count($contrats) > 0):?>
                    <section class="afficheContrat">
                        <?php
                            for ($i = 0; $i < count($contrats); $i++)  {
                                // if($contrats[$i]->getEtat() == "resilier") {
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

                            
                            // }
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

            <section id="frameC">
                <section class="sectionCreation">
                    <!-- form for selecting the contract to be modified -->
                    <form method="POST" action = "../controlleurs/selectContratModifier.php" class="formSelectContrat">
                        <div class="headerForm">
                            <h1>MODIFIER CONTRAT</h1>
                        </div>
                        <div class="divInputs">
                            <label for="idContrat" class="labelSelectContrat">Numéro de Contrat</label> <br>
                            <select name = "idContrat" class="champSelect" onchange="this.form.submit()">
                                <option value="">Choisi le contrat à modifier</option>
                                <?php
                                    foreach(($contrats = getListeContrats()) as $contrat) {
                                        $idContrat = $contrat->getIdContrat($contrat) ;
                                        echo "<option value = ".$idContrat.">".$idContrat.". ".$contrat->getDateCreation()."/ APP : ".$contrat->getIdAppartement().". ".$contrat->getCategorieAppartement()."/".$contrat->getTypeAppartement()." / LOC : ".$contrat->getIdentiteLocataire(1)." ".$contrat->getIdentiteLocataire(2)."</option>" ;
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            "<input type =\"hidden\" name = \"numContrat\" value = ".$contrat->getNumContrat()."/>";
                            "<input type = \"hidden\" name = \"dateCreation\" value  = ".$contrat->getDateCreation()."/>";
                        ?>
                    </form>
                    
                    <!-- form to modify contract data -->
                    <form method="POST" action="../controlleurs/modifierContrat.php" class="formChangerContrat">
                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for="etat">Etat</label> <br>
                                <select name = "etat" class="champSelect">
                                    <?php
                                    if(isset($_SESSION['idContrat'])) {
                                            foreach(($contrats = getListeContrats()) as $contrat) {
                                                if($_SESSION['idContrat'] == ($contrat->getIdContrat($contrat))) {
                                                    if($contrat->getEtat() == "resilier") {
                                                        echo "<option value = ".$contrat->getEtat().">".$contrat->getEtat()."</option>";
                                                        echo "<option value = \"encours\">encours</option>";  
                                                    }
                                                    else {
                                                        echo "<option value = ".$contrat->getEtat().">".$contrat->getEtat()."</option>";
                                                        echo "<option value = \"resilier\">resilier</option>";
                                                    }
                                                }
                                            }
                                        
                                        }
                                        else {
                                            echo "<option value=\"\">Choisi un Etat</option>";
                                        }
                                    ?>
                                </select><br><br>

                                <label for="idLocataire">Location</label> <br>
                                <select name = "idLocataire" class="champSelect">
                                    <?php
                                        if(isset($_SESSION['idContrat'])) {
                                            foreach(($contrats = getListeContrats()) as $contrat) {
                                                if($_SESSION['idContrat'] == ($contrat->getIdContrat($contrat))) {
                                                    echo "<option value = ".$contrat->getIdLocataire().">".$contrat->getIdentiteLocataire(1)." ".$contrat->getIdentiteLocataire(2)."</option>" ;
                                                }
                                            }

                                            foreach(($contrats = getListeContrats()) as $contrat) {
                                                if($_SESSION['idContrat'] != ($contrat->getIdContrat($contrat))) {
                                                    echo "<option value = ".$contrat->getIdLocataire().">".$contrat->getIdentiteLocataire(1)." ".$contrat->getIdentiteLocataire(2)."</option>" ;
                                                }
                                            }
                                        }
                                        else {
                                            echo "<option value=\"\">Choisi un locataire</option>";
                                        }
                                    ?>
                                </select><br><br>
                            
                                <label for="idAppartement">Numéro de Location</label> <br>
                                <select name = "idAppartement" class="champSelect">
                                    <?php
                                        if(isset($_SESSION['idContrat'])) {
                                            foreach(($contrats = getListeContrats()) as $contrat) {
                                                    if($_SESSION['idContrat'] == ($contrat->getIdContrat($contrat))) {
                                                        foreach(($appartements = getListeAppartements()) as $appartement) {
                                                            if(($contrat->getIdAppartement()) == ($appartement->getIdAppartement($appartement))) {
                                                                echo "<option value = ".$appartement->getIdAppartement($appartement).">".$appartement->getIdAppartement($appartement).". ".$contrat->getCategorieAppartement()."/".$contrat->getTypeAppartement()."</option>" ;
                                                            }
                                                        }

                                                        foreach(($appartements = getListeAppartements()) as $appartement) {
                                                            if(($contrat->getIdAppartement()) != ($appartement->getIdAppartement($appartement))) {
                                                                echo "<option value = ".$appartement->getIdAppartement($appartement).">".$appartement->getIdAppartement($appartement).". ".$contrat->getCategorieAppartement()."/".$contrat->getTypeAppartement()."</option>" ;
                                                            }
                                                        }
                                                    }
                                            }
                                        }
                                        else {
                                            echo "<option value=''>Choisi le numéro locataire</option>";
                                        }
                                    ?>
                                </select><br><br>
                            </div>

                            <div class="divInputsII">
                                <label for="dateDebut">Date Début</label> <br>
                                <?php
                                    if(isset($_SESSION['idContrat'])) {
                                        foreach(($contrats = getListeContrats()) as $contrat) {
                                            if($_SESSION['idContrat'] == ($contrat->getIdContrat($contrat))) {
                                                echo "<input type=\"date\" name=\"dateDebut\" class=\"champEntree\" value=\"".$contrat->getDateDebut()."\"/> <br><br>";
                                            }
                                        }
                                    }
                                    else {
                                        echo "<input type=\"date\" name=\"dateDebut\" class=\"champEntree\"/> <br><br>";
                                    }
                                ?>

                                <label for="dateFin">Date Fin</label> <br>
                                <?php
                                    if(isset($_SESSION['idContrat'])) {
                                        foreach(($contrats = getListeContrats()) as $contrat) {
                                            if($_SESSION['idContrat'] == ($contrat->getIdContrat($contrat))) {
                                                echo "<input type=\"date\" name=\"dateFin\" class=\"champEntree\" value=\"".$contrat->getDateFin()."\"/> <br><br>";
                                            }
                                        }
                                    }
                                    else {
                                        echo "<input type=\"date\" name=\"dateFin\" class=\"champEntree\"/> <br><br>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="divCancel">
                            <!-- <button type="button" class="btnCancelModifier">Cancel</button> -->

                            <input type="submit" class="btnSubmit" name ="enregistrer" value="Modifier"/> <br>
                        </div>
                    </form>    
                </section>
            </section>
        </section>
    </body>
</html>