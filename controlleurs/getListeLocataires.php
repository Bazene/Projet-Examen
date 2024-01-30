<?php
    include_once ("../configuration/config.php");
    include_once ("../models/locataire.php");

    function getListeLocataires() {
        return Locataire::getLocataires();
    }