<?php
    class Proprietaire {
        private $numProprietaire ;
        private $nomProprietaire ;
        private $prenomProprietaire ;
        private $adresse1Proprietaire ;
        private $adresse2Proprietaire ;
        private $codePostalProprietaire ;
        private $villeProprietaire ;
        private $numTel1Proprietaire ;
        private $numTel2Proprietaire ;
        private $CAcumule ;
        private $email ;
        private $photo;

        public function __construct($numProprietaire, $nomProprietaire, $prenomProprietaire, $adresse1Proprietaire, $adresse2Proprietaire, $codePostalProprietaire, $villeProprietaire, $numTel1Proprietaire, $numTel2Proprietaire, $CAcumule, $email, $photo){
            $this->numProprietaire = $numProprietaire ;
            $this->nomProprietaire = $nomProprietaire ;
            $this->prenomProprietaire = $prenomProprietaire ;
            $this->adresse1Proprietaire = $adresse1Proprietaire ;
            $this->adresse2Proprietaire = $adresse2Proprietaire ;
            $this->codePostalProprietaire = $codePostalProprietaire ;
            $this->villeProprietaire = $villeProprietaire ;
            $this->numTel1Proprietaire = $numTel1Proprietaire ;
            $this->numTel2Proprietaire = $numTel2Proprietaire ;
            $this->CAcumule = $CAcumule ;
            $this->email = $email ;
            $this->photo = $photo;
        }

        // funtion to enregister personne
        public function enregistrerProprietaire() {
            global $db ;
            $resultat = false ;

            $query = 'INSERT INTO proprietaire(numProprietaire, nomProprietaire, prenomProprietaire, adresse1Proprietaire, adresse2Proprietaire, codePostalProprietaire, villeProprietaire, numTel1Proprietaire, numTel2Proprietaire, CAcumule, email, photo) VALUES(:numProprietaire, :nomProprietaire, :prenomProprietaire, :adresse1Proprietaire, :adresse2Proprietaire, :codePostalProprietaire, :villeProprietaire, :numTel1Proprietaire, :numTel2Proprietaire, :CAcumule, :email, :photo)' ;
            $prepareQuery = $db->prepare($query) ;
            $execution = $prepareQuery->execute([
                ':numProprietaire' => $this->numProprietaire,
                ':nomProprietaire' => $this->nomProprietaire,
                ':prenomProprietaire' => $this->prenomProprietaire,
                ':adresse1Proprietaire' => $this->adresse1Proprietaire,
                ':adresse2Proprietaire' => $this->adresse2Proprietaire,
                ':codePostalProprietaire' => $this->codePostalProprietaire,
                ':villeProprietaire' => $this->villeProprietaire,
                ':numTel1Proprietaire' => $this->numTel1Proprietaire,
                ':numTel2Proprietaire' => $this->numTel2Proprietaire,
                ':CAcumule' => $this->CAcumule,
                ':email' => $this->email,
                ':photo' => $this->photo
            ]);
            
            if($execution) {
                $resultat = true;
            }
            return $resultat ;
        }

        // getters functions

        public function getIdProprietaire($PROPRIETAIRE) {
            global $db;

            $query = 'SELECT * FROM proprietaire WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $proprietaires = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $proprietaire = new Proprietaire ($data['numProprietaire'], $data['nomProprietaire'], $data['prenomProprietaire'], $data['adresse1Proprietaire'], $data['adresse2Proprietaire'], $data['codePostalProprietaire'], $data['villeProprietaire'], $data['numTel1Proprietaire'], $data['numTel2Proprietaire'], $data['CAcumule'], $data['email'], $data['photo']) ;
                    $proprietaires[$data['id']] = $proprietaire;
                } 
            }
            
            $idProprietaire = NULL ;
            foreach($proprietaires as $proprietaire) {
                if($proprietaire = $PROPRIETAIRE) {
                    $idProprietaire = array_search($proprietaire, $proprietaires);
                }
            }
            return $idProprietaire;
        }

        static function getProprietaire() {
            global $db;

            $query = 'SELECT * FROM proprietaire WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $proprietaires = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $proprietaire = new Proprietaire ($data['numProprietaire'], $data['nomProprietaire'], $data['prenomProprietaire'], $data['adresse1Proprietaire'], $data['adresse2Proprietaire'], $data['codePostalProprietaire'], $data['villeProprietaire'], $data['numTel1Proprietaire'], $data['numTel2Proprietaire'], $data['CAcumule'], $data['email'], $data['photo']) ;
                    array_push($proprietaires, $proprietaire);
                } return $proprietaires;
            } else return [];
        }

        public function getNumProprietaire() {
            return $this->numProprietaire;
        }
        public function getNomProprietaire() {
            return $this->nomProprietaire;
        }
        public function getPrenomProprietaire() {
            return $this->prenomProprietaire ;
        }
        public function getAdresse1Proprietaire() {
            return $this->adresse1Proprietaire;
        }
        public function getAdresse2Proprietaire() {
            return $this->adresse2Proprietaire;
        }
        public function getCodePostalProprietaire() {
            return $this->codePostalProprietaire;
        }
        public function getVilleProprietaire() {
            return $this->villeProprietaire;
        }
        public function getNumTel1Proprietaire() {
            return $this->numTel1Proprietaire;
        }
        public function getNumTel2Proprietaire () {
            return $this->numTel2Proprietaire;
        }
        public function getCAcumule() {
            return $this->CAcumule;
        }
        public function getEmail() {
            return $this->email;
        }

        /**
         * Get the value of photo
         */ 
        public function getPhoto()
        {
                return $this->photo;
        }
    }
?>