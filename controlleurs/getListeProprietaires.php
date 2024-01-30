<?php
    include_once ("../configuration/config.php");
    include_once ("../models/proprietaire.php");

    function getListeProprietaires() {
        return Proprietaire :: getProprietaire();
    }