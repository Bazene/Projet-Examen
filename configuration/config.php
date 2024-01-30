<?php
    $dsn='mysql:host=localhost;dbname=immobilier';
    $login = 'root';
    $password = 'root';

    $db = new PDO($dsn, $login, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);