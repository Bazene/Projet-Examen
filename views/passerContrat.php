<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Passer Contrat</title>
        <?php include_once ("../includes/links.php"); ?>
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
                    <!-- <button id="printBtnC">Imprimer</button> -->
                </div>

                <div>
                    <button class="btnAjouter">Passer Contrat</button>
                </div>
            </section>

            <section class="frameCreation">
                <section class="sectionCreation" style="margin-top:150px;">
                    <form method="POST" action="../controlleurs/enregistrerContrat.php">
                        <div class="headerForm">
                            <h1>PASSER CONTRAT</h1>
                        </div>

                        <div class="divInputs">
                            <div class="divInputsI">
                                <label for="numContrat">Numéro de Contrat</label> <br>
                                <input type="number" name="numContrat" class="champEntree" required/> <br><br>

                                <label for="dateCreation">Date Création</label> <br>
                                <input type="date" name="dateCreation" class="champEntree" required/> <br><br>

                                <label for="etat">Etat</label> <br>
                                <select name = "etat" class="champSelect" required>
                                    <option value = "">Choisi l'état de Contrat</option>
                                    <option value = "encours">En Cours</option>
                                    <option value = "resilier">Cloturé</option>;
                                </select><br><br>

                                <label for="idLocataire">Numéro Locataire</label> <br>
                                <select name = "idLocataire" class="champSelect" required>
                                    <option value="">Choisi un locataire</option>
                                    <?php
                                        foreach(($locataires = getListeLocataires()) as $locataire) {
                                            echo "<option value = ".$locataire->getIdLocataire($locataire).">".$locataire->getIdLocataire($locataire).". ".$locataire->getNomLocataire()." ".$locataire->getPrenomLocataire()."</option>" ;
                                        }
                                    ?>
                                </select><br><br>
                            </div>

                            <div class="divInputsII">
                                <label for="dateDebut">Date Début</label> <br>
                                <input type="date" name="dateDebut" class="champEntree" required/> <br><br>

                                <label for="dateFin">Date Fin</label> <br>
                                <input type="date" name="dateFin" class="champEntree" required/> <br><br>
                                
                                <label for="idAppartement">Numéro Appartement</label> <br>
                                <select name = "idAppartement" class="champSelect" required>
                                    <option value="">Choisi un appartement</option>
                                    <?php
                                        if(!empty(getListeAppartements())) {
                                            foreach(($appartements = getListeAppartements()) as $appartement) {

                                                if(($appartement->getDisponibilite()) == 1) {
                                                    // "<input type =\"hidden\" name = \"Objetappartement\" value = ".$appartement."/>";
                                                    $_SESSION['appartemet'] = $appartement; // on crée une variable session appartement de type Appartement
                                                    echo "<option value = ".$appartement->getIdAppartement($appartement).">".$appartement->getIdAppartement($appartement).". ".$appartement->getCategorie()."/".$appartement->getTypeAppartement()."</option>" ;
                                                }
                                            }
                                        }
                                        else {
                                            echo "<option>Aucun appartement n'est enregistrer</option>";
                                        }
                                    ?>
                                </select><br><br>
                                
                            </div>
                        </div>

                        <div class="divCancel">
                            <button type="button" class="btnCancel">Cancel</button>
                            <input type="submit" class="btnSubmit" value="Enregistrer"/>  
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

                                foreach(($appartements = getListeAppartements()) as $appartement) {
                                    if($appartement->getIdAppartement($appartement) == $contrats[$i]->getIdAppartement()) {
                                        $appartement = $appartement ;
                                        break;
                                    }
                                }
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