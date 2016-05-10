<?php
$auth=0;
include "lib/includes.php";

if(isset($_POST['login']) && isset($_POST['password'])){
        $login = $db->quote($_POST['login']);
        $pwd = sha1($_POST['password']);
        $sql = "select * from user where login=$login and password = '$pwd'";

        $select = $db->query($sql);
        $req = $select->fetch();
        if($select->rowCount()>0){
            if(isset($_POST['rememberme'])){
                setcookie('login', $req->login, time()+365*24*3600, null, null, false, true);
                setcookie('pwd', $req->password, time()+365*24*3600, null, null, false, true);
            }
            $_SESSION['id'] = $req->id;
            $_SESSION['level'] = $req->level;
            $_SESSION['login'] = $req->login;
            $_SESSION['pwd'] = $req->password;
            $_SESSION['mail'] = $req->email;
            $_SESSION['nb_insert'] = $req->nb_insert;
            $_SESSION['new_user'] = $req->new;
            $_SESSION['token'] = md5(time()*rand(173, 638));
            setFlash("Bonjour " . $_POST['login']);

            if($_SESSION['level'] == 0){
                header('Location:' .WEBROOT_ADMIN.'admin.php');
                die();
            }
            if($_SESSION['level'] == 1 && $_SESSION['new_user'] != 0){
                header('Location:' . WEBROOT . 'game.php');
                die();
            }else{
                 setFlash("Vous devez attendre que votre compte soit validé par un administrateur", "danger");
            }
        }
        if($select->rowCount()==0){
            $_SESSION['id'] = $select->fetch();
            setFlash("Veuillez vérifier vos identifiants", "danger");
        }
    }
include "partials/header.php";
include "partials/navbar_user.php"
?>

<div class="row">
<div class="container-fluid vertical-center ">
        <form action="#" method="post" class="col-xs-11 col-sm-6 col-lg-3">
                <div class="form-group ">
                    <label for="login">Login</label>
                     <input type="text" class="form-control" id="login" name="login">

                </div>

                <div class="form-group ">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-success">Se Connecter</button>
                <a href="form_inscription.php" class="btn btn-primary">Inscription</a>
				<div class="clear"></div>
                <a href="email_forgot_old.php" class="forgot">Mot de passe oublié ?</a>
                <input type="checkbox" class="rememberme" id="remember_checkox" name="rememberme"><label for="remember_checkox">Se souvenir de moi</label>

        </form>
</div>
</div>


<?php
include "partials/footer.php";
?>