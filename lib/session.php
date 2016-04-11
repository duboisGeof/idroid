<?php
function flash(){
    if(isset($_SESSION['Flash'])){
        extract($_SESSION['Flash']);
        unset($_SESSION['Flash']);
        return "<span class='form center-block alert alert-$type'>$message</span>";
    }

}

function setFlash($message, $type = 'success'){
    $_SESSION['Flash']['message'] = $message;
    $_SESSION['Flash']['type'] = $type;
}