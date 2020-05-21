<?php

function connexpdo($base,$user,$password){
    $dsn = "pgsql:dbname=$base;host=127.0.0.1;port=5432";
    return new PDO($dsn, $user, $password);
    /*try {

    } catch (PDOException $e){
        echo 'Connexion échouée :'. $e->getMessage();
    }*/
}