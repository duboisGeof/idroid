<?php

if(!isset($_SESSION['id']) AND isset($_COOKIE['login'], $_COOKIE['pwd']) AND !empty($_COOKIE['login']) AND !empty($_COOKIE['pwd'])){
    $login = $_COOKIE['login'];
    $pwd = $_COOKIE['pwd'];
    $sql = "select * from user where login=$login and password = '$pwd'";

    $select = $db->query($sql);
    $req = $select->fetch();
    if($select->rowCount()>0){
        $_SESSION['id'] = $req->id;
        $_SESSION['level'] = $req->level;
        $_SESSION['login'] = $req->login;
        $_SESSION['pwd'] = $req->password;
        $_SESSION['mail'] = $req->email;
        $_SESSION['nb_insert'] = $req->nb_insert;
        setFlash("Bonjour " . $_POST['login']);

        if($_SESSION['level'] == 0){
            header('Location:' .WEBROOT_ADMIN.'admin.php?token='.$_SESSION['token']);
            die();
        }
        if($_SESSION['level'] == 1){
           header('Location:' . WEBROOT . 'game.php?token='.$_SESSION['token']);
            die();
        }
    }
}