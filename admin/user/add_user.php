<?php
include "../../lib/includes.php";

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

$check_insert = null;

if(isset($_POST['login']) && isset($_POST['password'])){
    $login = str_replace("'", "",  $db->quote($_POST['login']));
    $pwd = sha1($_POST['password']);

    $select_exist = $db->query("select id from user where login ='$login'");
    $check_exist = $select_exist->rowCount();
    if($check_exist == 0){
        $req = $db->prepare('INSERT INTO user (login, password) VALUES(:login, :password)');
        $req->execute(array(
            'login' => $login,
            'password' => $pwd
        ));
        $check_insert = $req->rowCount();

        if($check_insert == 1){
            setFlash('utilisateur enregistré');

        }
        if($check_insert == 0){
            setFlash('Veuillez vérifier les informations', 'danger');
        }
    }else{
        setFlash('existe deja', 'danger');
    }
}

include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>
    <div class="container center-block vertical-center">
        <div class="row">
            <form action="#" method="post">
                <div class="form-group ">
                    <label for="login">Login</label>
                    <?php echo input('login'); ?>
                </div>

                <div class="form-group ">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>


                <button type="submit" class="btn btn-default">Valider</button>
                <a href="../../form_inscription.php" class="btn btn-primary">Annuler</a>

            </form>
        </div>
    </div>


<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/footer.php");
?>