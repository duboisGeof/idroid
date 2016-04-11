<?php

if(!isset($_SESSION['token'])){
    $_SESSION['token'] = md5(time()*rand(173, 638));
}

if(isset($_GET['token']) && $_GET['token'] != $_SESSION['token']){
   
    header('Location:' . WEBROOT . '../logout.php');
    die();
}