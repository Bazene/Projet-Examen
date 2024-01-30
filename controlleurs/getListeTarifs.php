<?php
    include_once ("../configuration/config.php");
    include_once ("../models/tarif.php");

    function getListeTarifs() {
        return Tarif::getTarifs();
    }