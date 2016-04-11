<?php
$auth=0;
include ('lib/includes.php');
setcookie("login", "", time()-3600);
setcookie("pwd", "", time()-3600);
$_SESSION = array();
setFlash('Vous etes deconnecter', 'danger');
header('Location:' . WEBROOT. 'index.php');