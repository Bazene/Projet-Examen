<?php
    class Contrat {
        private $numContrat;
        private $etat;
        private $dateCreation;
        private $dateDebut;
        private $dateFin;
        private $idAppartement;
        private $idLocataire;

        public function __construct($numContrat, $etat, $dateCreation, $dateDebut, $dateFin, $idAppartement, $idLocataire) {
            $this->numContrat = $numContrat;
            $this->etat = $etat;
            $this->dateCreation = $dateCreation;
            $this->dateDebut = $dateDebut;
            $this->dateFin = $dateFin;
            $this->idAppartement = $idAppartement;
            $this->idLocataire = $idLocataire;
        }

        public function enregistrerContrat() {
            global $db;

            $query = 'INSERT INTO contrat(numContrat, etat, dateCreation, dateDebut, dateFin, idAppartement, idLocataire) VALUES(:numContrat, :etat, :dateCreation, :dateDebut, :dateFin, :idAppartement, :idLocataire)';
            $prepareQuery = $db -> prepare($query);
            $execution = $prepareQuery -> execute([
                ':numContrat' => $this->numContrat,
                ':etat' => $this->etat,
                ':dateCreation' => $this->dateCreation,
                ':dateDebut' => $this->dateDebut,
                ':dateFin' => $this->dateFin,
                ':idAppartement' => $this->idAppartement,
                ':idLocataire' => $this->idLocataire
            ]);

            return $execution ? true:false;
        }

        static function getContrats() {
            global $db ;

            $query = 'SELECT * FROM contrat WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $contrats = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $contrat = new Contrat($data['numContrat'], $data['etat'], $data['dateCreation'], $data['dateDebut'], $data['dateFin'], $data['idAppartement'], $data['idLocataire']);
                    array_push($contrats, $contrat);
                } return $contrats;
            } else return [];
        }

        public function getIdContrat($CONTRAT) {
            global $db ;

            $query = 'SELECT * FROM contrat WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $contrats = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $contrat = new Contrat($data['numContrat'], $data['etat'], $data['dateCreation'], $data['dateDebut'], $data['dateFin'], $data['idAppartement'], $data['idLocataire']);
                    $contrats[$data['id']] = $contrat ;
                }
            }

            $idContrat = NULL ;
            foreach($contrats as $contrat) {
                if($contrat == $CONTRAT) {
                    $idContrat = array_search($contrat, $contrats);
                }
            }
            return $idContrat;
        } 

         
        static function modifierContrat($CONTRAT) {
            global $db;
            
            $query = 'UPDATE contrat SET numContrat = :numContrat, etat =:etat, dateDebut = :dateDebut, dateFin = :dateFin, idAppartement = :idAppartement, idLocataire = :idLocataire WHERE id =:id';
            $prepareQuery = $db -> prepare($query);
            $execution = $prepareQuery->execute([
                ':id' => $CONTRAT->getIdContrat($CONTRAT),
                ':numContrat' => $CONTRAT->getNumContrat(),
                ':etat' => $CONTRAT->getEtat(),
                ':dateDebut' => $CONTRAT->getDateDebut(),
                ':dateFin' => $CONTRAT->getDateFin(),
                ':idAppartement' => $CONTRAT->getIdAppartement(),
                ':idLocataire' => $CONTRAT->getIdLocataire()
            ]);

            return $execution ? true:false;
        }
        
        public function getCategorieAppartement() {
            global $db;
            
            $query = 'SELECT categorie FROM appartement JOIN contrat ON appartement.id = :idAppartement';
            $prepareQuery = $db -> prepare($query);
            $execution = $prepareQuery->execute([
                ':idAppartement' => $this->idAppartement
            ]);

            if($execution) {
                if($data = $prepareQuery->fetch()) {
                    $categorieAppartement = $data['categorie'];
                    return $categorieAppartement ;
                } else return null ;
            } else return null ;
        }

        public function getTypeAppartement() {
            global $db;
            
            $query = 'SELECT typeAppartement FROM appartement JOIN contrat ON appartement.id = :idAppartement';
            $prepareQuery = $db -> prepare($query);
            $execution = $prepareQuery->execute([
                ':idAppartement' => $this->idAppartement
            ]);

            if($execution) {
                if($data = $prepareQuery->fetch()) {
                    $typeAppartement = $data['typeAppartement'];
                    return $typeAppartement ;
                } else return null ;
            } else return null ;   
        }

        public function getIdentiteLocataire($num) {
            global $db;
            
            $query = 'SELECT nomLocataire, prenomLocataire, numLocataire, email, photo, adresse1Locataire, adresse2Locataire  FROM locataire JOIN contrat ON locataire.id = :idLocataire';
            $prepareQuery = $db -> prepare($query);
            $execution = $prepareQuery->execute([
                ':idLocataire' => $this->idLocataire
            ]);

            if($execution) {
                if($data = $prepareQuery->fetch()) {
                    if(intval($num) == 1) {
                        return $data['nomLocataire'];
                    }
                    elseif(intval($num) == 2) {
                        return $data['prenomLocataire'] ;
                    }
                    elseif(intval($num) == 3) {
                        return $data['email'];
                    }
                    elseif(intval($num) == 4) {
                        return $data['photo'] ;
                    }
                    elseif(intval($num) == 5) {
                        return $data['numLocataire'];
                    }
                    elseif(intval($num) == 6) {
                        return $data['adresse1Locataire'];
                    }
                    elseif(intval($num) == 7) {
                        return $data['adresse2Locataire'];
                    }
                } else return null ;
            } else return null ;   
        }

        public function resilierContrat($CONTRAT) {
            global $db ;

            $query = 'UPDATE contrat SET etat = \'resilier\' WHERE id = :id';
            $prepareQuery = $db -> prepare($query) ;
            $execution = $prepareQuery -> execute([
                ':id' => $CONTRAT->getIdContrat($CONTRAT)
            ]);

            return $execution ? true : false;
        }

        /**
         * Get the value of numContrat
         */ 
        public function getNumContrat()
        {
                return $this->numContrat;
        }

        /**
         * Set the value of numContrat
         *
         * @return  self
         */ 
        public function setNumContrat($numContrat)
        {
                $this->numContrat = $numContrat;

                return $this;
        }

        /**
         * Get the value of etat
         */ 
        public function getEtat()
        {
                return $this->etat;
        }

        /**
         * Set the value of etat
         *
         * @return  self
         */ 
        public function setEtat($etat)
        {
                $this->etat = $etat;

                return $this;
        }

        /**
         * Get the value of dateCreation
         */ 
        public function getDateCreation()
        {
                return $this->dateCreation;
        }

        /**
         * Set the value of dateCreation
         *
         * @return  self
         */ 
        public function setDateCreation($dateCreation)
        {
                $this->dateCreation = $dateCreation;

                return $this;
        }

        /**
         * Get the value of dateDebut
         */ 
        public function getDateDebut()
        {
                return $this->dateDebut;
        }

        /**
         * Set the value of dateDebut
         *
         * @return  self
         */ 
        public function setDateDebut($dateDebut)
        {
                $this->dateDebut = $dateDebut;

                return $this;
        }

        /**
         * Get the value of dateFin
         */ 
        public function getDateFin()
        {
                return $this->dateFin;
        }

        /**
         * Set the value of dateFin
         *
         * @return  self
         */ 
        public function setDateFin($dateFin)
        {
                $this->dateFin = $dateFin;

                return $this;
        }

        /**
         * Get the value of idAppartement
         */ 
        public function getIdAppartement()
        {
                return $this->idAppartement;
        }

        /**
         * Set the value of idAppartement
         *
         * @return  self
         */ 
        public function setIdAppartement($idAppartement)
        {
                $this->idAppartement = $idAppartement;

                return $this;
        }

        /**
         * Get the value of idLocataire
         */ 
        public function getIdLocataire()
        {
                return $this->idLocataire;
        }

        /**
         * Set the value of idLocataire
         *
         * @return  self
         */ 
        public function setIdLocataire($idLocataire)
        {
                $this->idLocataire = $idLocataire;

                return $this;
        }
    }
?>