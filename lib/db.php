<?php

    try{
        $host="localhost";
        $dbname = "idroid";
        $name = "root";
        $pwd = "";

        $db = new PDO("mysql:host=$host; dbname=$dbname", $name, $pwd);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }catch (Exception $e){
        echo "Impossible de se connecter a la base de donnee";
        echo $e->getMessage();
        die();
    }
