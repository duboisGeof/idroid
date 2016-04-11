<?php
include "../lib/includes.php";
include "../partials/header.php";
include "../partials/navbar_admin.php";


if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}


?>


   

<?php include '../partials/footer.php';?>