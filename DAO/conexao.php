<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'hospital';

    $mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if($mysqli->error){
       die("Falhou " . $mysqli->error);
    }
?>
