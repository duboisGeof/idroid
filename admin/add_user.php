<?php
include "../lib/includes.php";

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

$check_insert = null;

if(isset($_POST['login']) && isset($_POST['pwd']) && isset($_POST['pwd_confirm'])){
    $login = str_replace("'", "",  $db->quote($_POST['login']));
    $pwd = sha1($_POST['pwd']);
    $pwd_confirm = sha1($_POST['pwd_confirm']);
    $email = $_POST['email'];
    
    
    $sql = ("select id from user where login ='$login' or email = '$email'");
    $select = $db->query($sql);
    $check_req = $select->fetch();

    if($select->rowCount() == 0){
        if ($_POST['pwd'] == $_POST['pwd_confirm']){
        $req = $db->prepare('INSERT INTO user (login, password, email) VALUES(:login, :password, :email)');
        $req->execute(array(
            'login' => $login,
            'password' => $pwd,
            'email' => $email,
        ));
        
            if ($req) {
                setFlash('Merci pour votre inscription');
                header('Location:' . WEBROOT . 'admin.php');
                die();
            }
        }
    }else{
        setFlash("Le nom d'utilisateur ou le mail est déja enregistrer", "danger");
    }

   
}

include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>
<h1>Ajouter un utilisateur</h1>
<div class="row">
    <div class="container-fluid vertical-center ">
        <div class="row">
            <form action="#" method="post" class="col-xs-offset-3 col-xs-12 col-sm-6 col-lg-3">
                <div class="form-group ">
                    <label for="login">Login</label>
                    <input type="text" class="form-control reset" id="login" name="login" autocomplete="off" placeholder="Nom d'utilisateur">
                    <span class="error_login error">Veuillez entrer un votre nom d'utilisateur</span>
                </div>
                
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="text" class="form-control reset" id="email" name="email" placeholder="Adresse mail">
                    <span class="error_email error">Veuillez entrer votre adresse mail</span>
                </div>

                <div class="form-group ">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de passe">
                    <span class="error_pwd error">Veuillez entrer votre mot de passe</span>
                </div>
                
                <div class="form-group ">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirmation de mot de passe">
                    <span class="error_pwd_confirm error">Veuillez confirmer votre mot de passe</span>
                </div>
                <button type="submit" class="btn btn-success">Valider</button>
                <button type="reset" class="btn btn-primary">Annuler</button>

            </form>
        </div>
    </div>
	</div>


<?php
include "../partials/footer.php";
?>