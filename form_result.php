<?php
include "lib/includes.php";
include "partials/header.php";

if($_SESSION['result'] == ""){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

$counting_node = $db->query('SELECT id FROM node');
$count_node = $counting_node->rowCount();
$new_id_left = $count_node+1;
$new_id_right = $count_node+2;

$select_id_result = $db->prepare('SELECT id FROM node where results=:result');
$select_id_result->execute(array(':result'=>$_SESSION['result']));
$id_result = $select_id_result->fetch(PDO::FETCH_OBJ);

$nb_insert = $_SESSION['nb_insert']+1;

if(isset($_POST['submit'])&& isset($_SESSION['token'])){

    $key        = '6LdpURMTAAAAAN9A4u708v8YrU74_IZocEzpfpp4' ;
    $response   = $_POST['g-recaptcha-response'];

    $gapi       = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $key . '&response='.$response;

    $json = json_decode(file_get_contents($gapi), true );

    if($json['success']){
        $req = $db->prepare('UPDATE node SET questions = :question, results = :result, id_user= :id_user, date_insert=NOW() WHERE id = :id');
        $req->execute(array(
            'question' => $_POST['new_question'],
            'result' => null,

            'id_user' => $_SESSION['id'],

            'id' => $id_result->id
        ));



        $req = $db->prepare('INSERT INTO node(results, id_user) VALUES(:result, :id_user)');
        $req->execute(array(
            'result' => $_POST['new_result'],
            'id_user' => $_SESSION['id'],
        ));

        $req = $db->prepare('INSERT INTO node(results, id_user) VALUES(:result, :id_user)');
        $req->execute(array(
            'result' => $_SESSION['result'],
            'id_user' => $_SESSION['id'],
        ));

        $req = $db->prepare('UPDATE user SET nb_insert = :nb_insert WHERE id = :id');
        $req->execute(array(
            'nb_insert' => $nb_insert,

            'id' => $_SESSION['id']
        ));

        $select_id_left = $db->prepare('SELECT id FROM node where results=:result');
        $select_id_left->execute(array(':result'=>$_POST['new_result']));
        $id_left = $select_id_left->fetch(PDO::FETCH_OBJ);

        $select_id_right = $db->prepare('SELECT id FROM node where results=:result');
        $select_id_right->execute(array(':result'=>$_SESSION['result']));
        $id_right = $select_id_right->fetch(PDO::FETCH_OBJ);



        $req = $db->prepare('UPDATE node SET id_left_node_children= :new_id_left, id_right_node_children= :new_id_right  WHERE id = :id');
        $req->execute(array(
            'new_id_left' => $id_left->id,
            'new_id_right' => $id_right->id,
            'id' => $id_result->id
        ));



        if ($req) {
            setFlash('Votre nouvelle reponse a bien été enregistrée');
            header('Location:' . WEBROOT . 'game.php');
            die();
        }
    }

    if (!$json['success']){
            echo "<div class='alert alert-danger'>Veuillez valider le captcha</div>";
    }
}
include "partials/navbar_user.php"
?>
<div class="container center-block vertical-center">

    <form method="post" class="form_result">

                <div class="form-group">
                    <label for="new_question">Inserer une nouvelle question</label>
                    <input type="text" class="form-control" id="new_question" name="new_question">
                    <p class="error_question error">Merci d'enregistrer une nouvelle question</p>
                </div>

                <div class="form-group">
                    <label for="new_result">Inserer votre reponse</label>
                    <input type="text" class="form-control" id="new_result" name="new_result">
                    <p class="error_result error">Merci d'enregistrer une nouvelle r�ponse</p>
                </div>

                <div class="g-recaptcha " data-sitekey="6LdpURMTAAAAANk-wOMIv0niGaZoNwXago2Qspfw"></div>
                <p class="error_captcha error">Merci d'enregistrer une cocher le captcha</p>

                <button type="reset" name='submit' value="Submit" class="btn btn-danger">Annuler</button>
                <button type="submit" name='submit' value="Submit"class="btn btn-success">Valider</button>

            </form>
</div>
<?php include 'partials/footer.php';?>
