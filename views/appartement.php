<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appartement</title>
        <?php include_once ("../includes/links.php"); ?>
        <link rel="stylesheet" href="../style/appartement.css"/>
        <script src="../fichierJs/structure.js" defer></script>
        <script src="../fichierJs/appartement.js" defer></script>
    </head>

    <body>
        <?php include_once ("../includes/header.php"); ?>
        <?php include_once ("../controlleurs/getListeProprietaires.php")?>
        <?php include_once ("../controlleurs/getListeTarifs.php"); ?>
        <?php include_once ("../controlleurs/getListeProprietaires.php") ?>
        <?php include_once ("../controlleurs/getListeAppartements.php"); ?>

        <section class="sectionAppartement">
            <section class="headerAppartement">
                 <div>
                    <!-- <button id="printBtnA">Imprimer</button> -->
                </div>

                <div>
                    <button class="btnAjouter">Ajouter Appartement</button>
                </div>
            </section>
            
            <section class="frameCreation">
                <section class="sectionCreation">
                    <form method="POST" action="../controlleurs/enregistrerAppartement.php" enctype="multipart/form-data">
                       
                        <div class="headerForm">
                           <h1>AJOUTER APPARTEMENT</h1>
                        </div>
                   
                        <div class="divInputs">
                            <div class="divInputsI">
                                
                                <label for="numLocation">Numéro Location</label> <br>
                                <input type="number" name="numLocation" class="champEntree"/> <br><br>
                                
                                <label for="categorie">Catégorie</label> <br>
                                <input type="text" name="categorie" class="champEntree"/> <br><br>

                                <label for="typeAppartement">Type</label> <br>
                                <input type="text" name="typeAppartement" class="champEntree"/> <br><br>

                                <label for="nbPersonnes">Nombre personnes</label> <br>
                                <input type="number" name="nbPersonnes" class="champEntree"/> <br><br>
                                
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
                                <input type="file" name="photo" class="champPhoto" required/><br><br>

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
                    
                        <div class="divCancel"> 
                            <button type="button" class="btnCancel">Cancel</button>
                            <input type="submit" class="btnSubmit" value="Enregistrer"/> <br>
                        </div>
                    </form>
                </section>
            </section>
            
            <section class="sectionAfficheAppart">
                <?php 
                    foreach(( $appartements = getListeAppartements()) as $appartement) {
                        // $disponibilite = "INDISPONIBLE"; 
                        // if($appartement->getDisponibilite() == 1) {
                        //     $disponibilite = "DISPONIBLE" ;
                        // }

                        // la section qui sera généré à chaque fois
                        echo 
                            "<section class=\"sectionImgInfo\">
                                <div class=\"sectionCadre\">
                                    <div class=\"image\">
                                        <img src=\"../images/".$appartement->getPhoto()."\"/>
                                    </div>
        
                                    <div class=\"info\">
                                        <section class=\"infoAppart\">
                                            <div class=\"numAppart\">
                                                
                                                <span>".$appartement->getNumLocation()."</span>
                                            </div> 

                                            <div class=\"catgorie\">
                                                <i class=\"fas fa-home\" style =\"color:#87BBEE;\"></i>"."  ".$appartement->getCategorie()."<br>
                                            </div>

                                            <div class=\"adresse\">
                                                <i class=\"fas fa-map-marker-alt\"></i>"."".$appartement->getAdresseLocation()."
                                            </div>

                                            <div class=\"prix\">
                                                <span>$ ".$appartement->getPrixSemBS()."</span> Prix Sem BS <span style=\"color:black;\">/</span>
                                                <span>$ ".$appartement->getPrixSemHS()."</span> Prix Sem HS
                                            </div>

                                            <div class=\"divBtnPlus\">
                                                <button class=\"btnPlus\">...</button>
                                            </div>
                                        </section>
        
                                        <section class=\"plusInfo\">
                                            Type : ".$appartement->getTypeAppartement()."<br>
                                            Max : ".$appartement->getNbPersonnes()." "."Personnes <br>
                                            Equippements : ".$appartement->getEquipements()."
                                            <p class=\"numsTel\"> 
                                                <i class=\"fa fa-phone\" style=\"color:white; background-color:#150355; padding:5px; font-size:12px\"></i>"." ".$appartement->getNumTel1Proprietaire()."
                                                <i class=\"fab fa-whatsapp\" style = \"background-color:green; color :white; padding:5px; font-size:12px\"></i>"." ".$appartement->getNumTel2Proprietaire()." <br>  
                                            </p
                                        </section>
                                    </div>
                                </div>
                            </section>";
                    }
                    
                ?>

            </section>
                
        </section>
    </body>
</html>