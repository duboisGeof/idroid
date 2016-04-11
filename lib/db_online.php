<?php

    try{
        $host="db612238446.db.1and1.com";
        $dbname = "db612238446";
        $name = "dbo612238446";
        $pwd = "Biohazard401";

        $db = new PDO("mysql:host=$host; dbname=$dbname", $name, $pwd);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }catch (Exception $e){
        echo "Impossible de se connecter a la base de donnee";
        echo $e->getMessage();
        die();
    }
