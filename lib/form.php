<?php
function input($id){


   if(isset($_POST[$id])){
       $value = $_POST[$id];
   }
    else{
        $value = '';
    }

    return "<input type='text' class='form-control' id='$id' name='$id' value='$value'>";
}
?>