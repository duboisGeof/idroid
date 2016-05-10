<?php
include "lib/includes.php";
include "partials/header.php";

/**
 * Compter le nombre d'�lements o� il y a une question
 */
$counting = $db->query('SELECT * FROM node where questions IS NOT NULL');
$count = $counting->rowCount();


$select = $db->prepare('SELECT * FROM node where id=:id');
if(!isset($_POST['choix'])){
    $id = 1;
}
elseif ($_POST['choix'] == 'oui') {
    $id = $_POST['left'];
}
elseif ($_POST['choix'] == 'non') {
    $id = $_POST['right'];
}

$select->execute(array(':id'=>$id));
$nodes = $select->fetch(PDO::FETCH_OBJ);
$current_id_left = $nodes->id_left_node_children;
$current_id_right = $nodes->id_right_node_children;
$current_question = $nodes->questions;
$current_result = $nodes->results;

include "partials/header.php";
include "partials/navbar_user.php"
?>




    <div class="container-fluid vertical-center ">
        <form action="" method="POST" class="col-xs-11 col-sm-6 col-lg-3">

                <?php

                if($nodes->questions != ""){

                    echo  "<p>".$current_question . "</p><br>";
                    $_SESSION['question'] = $current_question;
                }
                if($nodes->questions == ""){
                    $_SESSION['result'] = $current_result;
                    header('Location:' . WEBROOT . 'result.php?token='.$_SESSION['token']);
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=result.php?token=' . $_SESSION['token'] . '">'; 
               		die();
                }
                ?>
                <input type="hidden" name="left" value="<?php echo $current_id_left; ?>">
                <input type="hidden" name="right" value="<?php echo $current_id_right; ?>">
                <input type="submit" class="btn btn-success" value="oui" name="choix"/>
                <input type="submit" class="btn btn-danger" value="non" name="choix"/>
        </form>
    </div>

<?php include 'partials/footer.php';?>