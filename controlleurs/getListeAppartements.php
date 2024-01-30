<?php

    include_once ("../configuration/config.php");
    include_once ("../models/appartement.php");

    function getListeAppartements() {
        return Appartement::getAppartements();
    }