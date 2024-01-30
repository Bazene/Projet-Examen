<?php
    class Appartement {
        private $idProprietaire;
        private $idTarif;
        private $numLocation;
        private $categorie;
        private $typeAppartement;
        private $nbPersonnes;
        private $adresseLocation;
        private $photo;
        private $equipements;
        private $disponibilite;
        
        public function __construct($idProprietaire, $idTarif, $numLocation, $categorie, $typeAppartement, $nbPersonnes, $adresseLocation, $photo, $equipements, $disponibilite) {
            $this->idProprietaire = $idProprietaire;
            $this->idTarif = $idTarif;
            $this->numLocation = $numLocation;
            $this->categorie = $categorie;
            $this->typeAppartement = $typeAppartement;
            $this->nbPersonnes = $nbPersonnes;
            $this->adresseLocation = $adresseLocation;
            $this->photo = $photo;
            $this->equipements = $equipements;
            $this->disponibilite = $disponibilite;
        }

        public function enregistrerAppartement() {
            global $db ;
            
            $query = 'INSERT INTO appartement(idProprietaire, idTarif, numLocation, categorie, typeAppartement, nbPersonnes, adresseLocation, photo, equipements, disponibilite) VALUES(:idProprietaire, :idTarif, :numLocation, :categorie, :typeAppartement, :nbPersonnes, :adresseLocation, :photo, :equipements, :disponibilite) ';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([
                ':idProprietaire' => $this->idProprietaire,
                ':idTarif' => $this->idTarif,
                ':numLocation' => $this->numLocation,
                ':categorie' => $this->categorie,
                ':typeAppartement' => $this->typeAppartement,
                ':nbPersonnes' => $this->nbPersonnes,
                ':adresseLocation' => $this->adresseLocation,
                ':photo' => $this->photo,
                ':equipements' => $this->equipements,
                ':disponibilite' => $this->disponibilite
            ]);

            return $execution ? true : false ;
    
        }

        public function getIdAppartement($APPARTEMENT) {
                global $db ;

                $query = 'SELECT * FROM appartement WHERE 1';
                $prepareQuery = $db->prepare($query);
                $execution = $prepareQuery->execute([]);
    
                $appartements = [];
                if($execution) {
                        while($data = $prepareQuery->fetch()) {
                                $appartement = new Appartement($data['idProprietaire'], $data['idTarif'],$data['numLocation'],
                                        $data['categorie'], $data['typeAppartement'], $data['nbPersonnes'], $data['adresseLocation'],
                                        $data['photo'], $data['equipements'], $data['disponibilite']);

                                $appartements[$data['id']] = $appartement;
                        }
                }

                $idAppartement = NULL ;
                foreach($appartements as $appartement) {
                    if($appartement == $APPARTEMENT) {
                        $idAppartement = array_search($appartement, $appartements);
                    }
                }
                return $idAppartement;
        }

        public function getIdentiteProprietaire($num) {
                global $db;
                
                $query = 'SELECT nomProprietaire, prenomProprietaire, numProprietaire, email, adresse1Proprietaire, adresse2Proprietaire  FROM proprietaire JOIN appartement ON appartement.id = :idProprietaire';
                $prepareQuery = $db -> prepare($query);
                $execution = $prepareQuery->execute([
                    ':idProprietaire' => $this->idProprietaire
                ]);
    
                if($execution) {
                    if($data = $prepareQuery->fetch()) {
                        if(intval($num) == 1) {
                            return $data['nomProprietaire'];
                        }
                        elseif(intval($num) == 2) {
                            return $data['prenomProprietaire'] ;
                        }
                        elseif(intval($num) == 3) {
                            return $data['email'];
                        }
                        elseif(intval($num) == 5) {
                            return $data['numProprietaire'];
                        }
                        elseif(intval($num) == 6) {
                            return $data['adresse1Proprietaire'];
                        }
                        elseif(intval($num) == 7) {
                            return $data['adresse2Proprietaire'];
                        }
                    } else return null ;
                } else return null ;   
        }

        static function getAppartements() {
                global $db;

                $query = 'SELECT * FROM appartement WHERE 1';
                $prepareQuery = $db->prepare($query);
                $execution = $prepareQuery->execute([]);

                $appartements = [];
                if($execution) {
                        while($data = $prepareQuery->fetch()) {
                                $appartement = new Appartement($data['idProprietaire'], $data['idTarif'],$data['numLocation'],
                                        $data['categorie'], $data['typeAppartement'], $data['nbPersonnes'], $data['adresseLocation'],
                                        $data['photo'], $data['equipements'], $data['disponibilite']);

                                array_push($appartements, $appartement);
                        } return $appartements;
                } else return [];
        }

        public function modifierDisponibilite($APPARTEMENT, $DISPONIBILITE) {
                global $db ;

                $query = 'UPDATE appartement SET disponibilite = :disponibilite WHERE id=:id';
                $prepareQuery = $db -> prepare($query);
                $execution = $prepareQuery ->execute([
                        ':id'=>$APPARTEMENT->getIdAppartement($APPARTEMENT),
                        ':disponibilite' => $DISPONIBILITE
                ]);

                return $execution ? true : false;
        }

        public function getNumTel1Proprietaire() {
                global $db;

                $query = 'SELECT numTel1Proprietaire FROM proprietaire JOIN appartement ON proprietaire.id = :idProprietaire';
                $prepareQuery = $db->prepare($query);
                $execution = $prepareQuery->execute([
                        ':idProprietaire' => $this->idProprietaire
                ]);
 
                $numTel1Proprietaire = null;
                if($execution) {
                        if($data = $prepareQuery->fetch()) {
                                $numTel1Proprietaire = $data['numTel1Proprietaire'];
                        }
                }
                return $numTel1Proprietaire;
        }

        public function getNumTel2Proprietaire() {
                global $db;

                $query = 'SELECT numTel2Proprietaire FROM proprietaire JOIN appartement ON proprietaire.id = :idProprietaire';
                $prepareQuery = $db->prepare($query);
                $execution = $prepareQuery->execute([
                        ':idProprietaire' => $this->idProprietaire
                ]);
 
                $numTel2Proprietaire = null;
                if($execution) {
                        if($data = $prepareQuery->fetch()) {
                                $numTel2Proprietaire = $data['numTel2Proprietaire'];
                        }
                }
                return $numTel2Proprietaire;
        }

        public function getNomsProprietaire($num) {
                global $db;

                $query = 'SELECT nomProprietaire, prenomProprietaire, email FROM proprietaire JOIN appartement ON proprietaire.id = :idProprietaire';
                $prepareQuery = $db->prepare($query);
                $execution = $prepareQuery->execute([
                        ':idProprietaire' => $this->idProprietaire
                ]);
 
                if($execution) {
                        if($data = $prepareQuery->fetch()) {
                                if(intval($num) == 1) {
                                        return $data['nomProprietaire'];
                                }
                                elseif (intval($num) == 2) {
                                        return $data['prenomProprietaire'];
                                }

                                else {
                                        return $data['email'];
                                }
                        } else return null;
                }
                else return null;
        }
        public function getPrixSemHS() {
                global $db;

                $query = 'SELECT prixSemHS FROM tarif JOIN appartement ON tarif.id = :idTarif';
                $prepareQuery = $db -> prepare($query);
                $execution = $prepareQuery -> execute([
                        ':idTarif' => intval($this->getIdTarif())
                ]);

                $prixSemHS = null ;
                if($execution) {
                        if($data = $prepareQuery->fetch()) {
                                $prixSemHS = intval($data['prixSemHS']) ;
                        }
                }
                return $prixSemHS;
        }

        public function getPrixSemBS() {
                global $db;

                $query = 'SELECT prixSemBS FROM tarif JOIN appartement ON tarif.id = :idTarif';
                $prepareQuery = $db -> prepare($query);

                $execution = $prepareQuery -> execute([
                        ':idTarif' => intval($this->getIdTarif())
                ]);

                $prixSemBS = null ;
                if($execution) {
                        if($data = $prepareQuery->fetch()) {
                                $prixSemBS = intval($data['prixSemBS']) ;
                        }
                }
                return $prixSemBS;
        }


        /**
         * Get the value of idProprietaire
         */ 
        public function getIdProprietaire()
        {
                return $this->idProprietaire;
        }

        /**
         * Get the value of idTarif
         */ 
        public function getIdTarif()
        {
                return $this->idTarif;
        }

        /**
         * Get the value of numLocation
         */ 
        public function getNumLocation()
        {
                return $this->numLocation;
        }

        /**
         * Get the value of categorie
         */ 
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Get the value of typeAppartement
         */ 
        public function getTypeAppartement()
        {
                return $this->typeAppartement;
        }

        /**
         * Get the value of nbPersonnes
         */ 
        public function getNbPersonnes()
        {
                return $this->nbPersonnes;
        }

        /**
         * Get the value of adresseLocation
         */ 
        public function getAdresseLocation()
        {
                return $this->adresseLocation;
        }

        /**
         * Get the value of equipements
         */ 
        public function getEquipements()
        {
                return $this->equipements;
        }

        /**
         * Get the value of photo
         */ 
        public function getPhoto()
        {
                return $this->photo;
        }

        /**
         * Get the value of disponibilite
         */ 
        public function getDisponibilite()
        {
                return $this->disponibilite;
        }
    }
?>