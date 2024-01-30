<?php
    include_once ("../configuration/config.php");
    include_once ("../models/contrat.php") ;

    function getListeContrats() {
        return Contrat :: getContrats() ;
    }