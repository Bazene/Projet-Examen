<?php
    class Locataire {
        private $numLocataire ;
        private $nomLocataire ;
        private $prenomLocataire ;
        private $adresse1Locataire ;
        private $adresse2Locataire ;
        private $codePostalLocataire ;
        private $villeLocataire ;
        private $numTel1Locataire ;
        private $numTel2Locataire ;
        private $email ;
        private $photo;

        public function __construct($numLocataire, $nomLocataire, $prenomLocataire, $adresse1Locataire, $adresse2Locataire, $codePostalLocataire, $villeLocataire, $numTel1Locataire, $numTel2Locataire, $email, $photo){
            $this->numLocataire = $numLocataire ;
            $this->nomLocataire = $nomLocataire ;
            $this->prenomLocataire = $prenomLocataire ;
            $this->adresse1Locataire = $adresse1Locataire ;
            $this->adresse2Locataire = $adresse2Locataire ;
            $this->codePostalLocataire = $codePostalLocataire ;
            $this->villeLocataire = $villeLocataire ;
            $this->numTel1Locataire = $numTel1Locataire ;
            $this->numTel2Locataire = $numTel2Locataire ;
            $this->email = $email ;
            $this->photo = $photo;
        }

        // funtion to enregister personne
        public function enregistrerLocataire() {
            global $db ;
            $resultat = false ;

            $query = 'INSERT INTO locataire(numLocataire, nomLocataire, prenomLocataire, adresse1Locataire, adresse2Locataire, codePostalLocataire, villeLocataire, numTel1Locataire, numTel2Locataire, email, photo) VALUES(:numLocataire, :nomLocataire, :prenomLocataire, :adresse1Locataire, :adresse2Locataire, :codePostalLocataire, :villeLocataire, :numTel1Locataire, :numTel2Locataire, :email, :photo)' ;
            $prepareQuery = $db->prepare($query) ;
            $execution = $prepareQuery->execute([
                ':numLocataire' => $this->numLocataire,
                ':nomLocataire' => $this->nomLocataire,
                ':prenomLocataire' => $this->prenomLocataire,
                ':adresse1Locataire' => $this->adresse1Locataire,
                ':adresse2Locataire' => $this->adresse2Locataire,
                ':codePostalLocataire' => $this->codePostalLocataire,
                ':villeLocataire' => $this->villeLocataire,
                ':numTel1Locataire' => $this->numTel1Locataire,
                ':numTel2Locataire' => $this->numTel2Locataire,
                ':email' => $this->email,
                ':photo' => $this->photo
            ]);
            
            if($execution) {
                $resultat = true;
            }
            return $resultat ;
        }

        // getters functions

        public function getIdLocataire($LOCATAIRE) {
            global $db;

            $query = 'SELECT * FROM locataire WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $locataires = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $locataire = new locataire ($data['numLocataire'], $data['nomLocataire'], $data['prenomLocataire'], $data['adresse1Locataire'], $data['adresse2Locataire'], $data['codePostalLocataire'], $data['villeLocataire'], $data['numTel1Locataire'], $data['numTel2Locataire'], $data['email'], $data['photo']) ;
                    $locataires[$data['id']] = $locataire;
                } 
            }
            
            $idlocataire = NULL ;
            foreach($locataires as $locataire) {
                if($locataire = $locataire) {
                    $idlocataire = array_search($locataire, $locataires);
                }
            }
            return $idlocataire;
        }

        static function getLocataires() {
            global $db;

            $query = 'SELECT * FROM locataire WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $Locataires = [];
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $Locataire = new Locataire ($data['numLocataire'], $data['nomLocataire'], $data['prenomLocataire'], $data['adresse1Locataire'], $data['adresse2Locataire'], $data['codePostalLocataire'], $data['villeLocataire'], $data['numTel1Locataire'], $data['numTel2Locataire'], $data['email'], $data['photo']) ;
                    array_push($Locataires, $Locataire);
                } return $Locataires;
            } else return [];
        }

        public function getNumLocataire() {
            return $this->numLocataire;
        }
        public function getNomLocataire() {
            return $this->nomLocataire;
        }
        public function getPrenomLocataire() {
            return $this->prenomLocataire ;
        }
        public function getAdresse1Locataire() {
            return $this->adresse1Locataire;
        }
        public function getAdresse2Locataire() {
            return $this->adresse2Locataire;
        }
        public function getCodePostalLocataire() {
            return $this->codePostalLocataire;
        }
        public function getVilleLocataire() {
            return $this->villeLocataire;
        }
        public function getNumTel1Locataire() {
            return $this->numTel1Locataire;
        }
        public function getNumTel2Locataire () {
            return $this->numTel2Locataire;
        }
        public function getEmail() {
            return $this->email;
        }

        public function getPhoto() {
            return $this->photo;
        }

    }
?>