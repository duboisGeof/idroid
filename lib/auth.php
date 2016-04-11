<?php
session_start();
if(!isset($auth)){
    if(!isset ($_SESSION['id'])){
        $admin = '/idroid/admin';
        
        if(dirname($_SERVER['SCRIPT_NAME']) == $admin){
           header('Location:' . WEBROOT . '../login.php');
        }else{
            header('Location:' . WEBROOT . 'login.php');
        }
        die();
    }
}
?>