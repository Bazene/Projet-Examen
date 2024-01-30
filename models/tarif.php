<?php
    class Tarif {
        private $codeTarif ;
        private $prixSemHS ;
        private $prixSemBS ;

        public function __construct($codeTarif, $prixSemHS, $prixSemBS) {
            $this->codeTarif = $codeTarif ;
            $this->prixSemHS = $prixSemHS ;
            $this->prixSemBS = $prixSemBS ;
        }

        public function enregistrerTarif() {
            global $db ;

            $query = 'INSERT INTO tarif(codeTarif, prixSemHS, prixSemBS) VALUES(:codeTarif, :prixSemHS, :prixSemBS)' ;
            $prepareQuery = $db->prepare($query) ;
            $execution =  $prepareQuery->execute([
                ':codeTarif' => $this->codeTarif,
                ':prixSemHS' => $this->prixSemHS,
                ':prixSemBS' => $this->prixSemBS
            ]);

            return $execution ? true : false;
        }

        public function getIdTarif($TARIF) {
            global $db;

            $query = 'SELECT * FROM tarif WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $tarifs = [] ;
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $tarif = new Tarif($data['codeTarif'], $data['prixSemHS'], $data['prixSemBS']);
                    $tarifs[$data['id']] = $tarif;
                }   
            }

            $idTarif = NULL;
            foreach($tarifs as $tarif) {
                if($tarif == $TARIF) {
                    $idTarif = array_search($tarif, $tarifs);
                }
            }
            return $idTarif;
        }
        
        static function getTarifs() {
            global $db;
            $query = 'SELECT * FROM tarif WHERE 1';
            $prepareQuery = $db->prepare($query);
            $execution = $prepareQuery->execute([]);

            $tarifs = [] ;
            if($execution) {
                while($data = $prepareQuery->fetch()) {
                    $tarif = new Tarif($data['codeTarif'], $data['prixSemHS'], $data['prixSemBS']);
                    array_push($tarifs, $tarif);
                }
                return $tarifs ;
            } else return $tarifs;
        }

        /**
         * Get the value of codeTarif
         */ 
        public function getCodeTarif()
        {
                return $this->codeTarif;
        }

        /**
         * Get the value of prixSemHS
         */ 
        public function getPrixSemHS()
        {
                return $this->prixSemHS;
        }

        /**
         * Get the value of prixSemBS
         */ 
        public function getPrixSemBS()
        {
                return $this->prixSemBS;
        }
    }
?>