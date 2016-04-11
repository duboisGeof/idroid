<?php
$auth=0;
include "lib/includes.php";

require('phpmailer/class.phpmailer.php');
require ('phpmailer/PHPMailerAutoload.php');

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);

}else{
    $section = "";
}

if(isset($_POST['code_submit'], $_POST['code'])){
    if(!empty($_POST['code'])){
        $check_code = htmlspecialchars($_POST['code']);
        $req_check_code = $db->prepare("select id from recuperation where email= :email and code= :code");
        $req_check_code->execute(array(
            'email' => $_SESSION['recup_mail'],
            'code' => $check_code,
        ));
        if($req_check_code->rowCount() == 1){
            $update_confirm = $db->prepare('UPDATE recuperation SET confirm = 1 WHERE email = :email');
            $update_confirm->execute(array(
                'email' =>  $_SESSION['recup_mail'],
            ));

            header('Location:' .WEBROOT.'email_forgot_old.php?section=changepwd');
            die();
        }else{
            setFlash("Code invalide", "danger");
        }
    }else{
        setFlash("Veuillez entrez votre code de confirmation", "danger");
    }
}

if(isset($_POST['pwd_submit'])){
    if(isset($_POST['change_pwd'], $_POST['change_pwd_confirm'])){
        $check_confirm = $db->prepare("select confirm from recuperation where email= :email");
        $check_confirm->execute(array(
            'email' => $_SESSION['recup_mail'],
        ));
        $check_confirm = $check_confirm->fetch();
        $check_confirm = $check_confirm->confirm;
        if ($check_confirm == 1){


            $pwd = htmlspecialchars($_POST['change_pwd']);
            $pwd_confirm = htmlspecialchars($_POST['change_pwd_confirm']);
            if(!empty($pwd) AND !empty ($pwd_confirm)){
                if($pwd == $pwd_confirm){
                    $pwd = sha1($pwd);
                    $update_pwd = $db->prepare('UPDATE user SET password = :password WHERE email = :email');
                    $update_pwd->execute(array(
                        'password' => $pwd,
                        'email' =>  $_SESSION['recup_mail'],
                    ));
                    $del_code = $db->prepare("delete from recuperation where email= :email");
                    $del_code->execute(array(
                        'email' => $_SESSION['recup_mail'],
                    ));
                    header('Location:' .WEBROOT.'login.php');
                    die();
                }else{
                    setFlash("Les mot de passe ne sont pas identiques", "danger");
                }
            }else{
                setFlash("Veuillez remplir tout les champs", "danger");
            }
        }else{
            setFlash("Veuillez valide votre mail grace au code de recup�ration", "danger");
        }
    }else{
        setFlash("Veuillez remplir tout les champs", "danger");

    }

}


if(isset($_POST['recup_mail']) && isset($_POST['recup_submit'])){
        if(!empty($_POST['recup_mail'])){
            $recup_mail = htmlspecialchars($_POST['recup_mail']);
            if(filter_var($recup_mail, FILTER_VALIDATE_EMAIL)){
                $mail_exist = $db->prepare('SELECT id, login FROM user WHERE email= :mail');
                $mail_exist->execute(array(':mail'=>$recup_mail));
                if($mail_exist->rowCount() == 1){
                    $login = $mail_exist->fetch();
                    $login = $login->login;
                    $_SESSION['recup_mail'] = $recup_mail;
                    $recup_code = "";
                    for($i=0; $i < 8; $i++){
                        $recup_code .= mt_rand(0,9);
                    }

                    $req_mail_exist = $db->prepare('SELECT id FROM recuperation WHERE email= :mail');
                    $req_mail_exist->execute(array(':mail'=>$recup_mail));
                    if($req_mail_exist->rowCount() == 1){
                        $insert = $db->prepare('UPDATE recuperation SET code = :code WHERE email = :mail');
                        $insert->execute(array(
                            'code' => $recup_code,
                            'mail' => $recup_mail,
                        ));

                    }else{
                        $insert = $db->prepare('INSERT INTO recuperation(email, code) VALUES(:mail, :code)' );
                        $insert->execute(array(
                            'mail' => $recup_mail,
                            'code' => $recup_code,
                        ));
                    }

                    $headers  = "MIME-Version: 1.0\r\n";
                    $headers .= 'FROM: "geoffrey-dubois.fr" <dubois.geof@gmail.com>'."\n";
                    $headers .= 'Content-Type: text/html; charset="utf-8"' ."\n";
                    $headers .= 'Content-Transfer-Encoding: 8bit';

                    $message='
                        <html>
                            <head>
                                <title>R�cup�ration de mot de passe</title>
                                <meta charset="utf-8"/>
                            </head>
                                <body>
                                    <div>Bonjour <b>'.$login.',</b><br><br>
                                        Vous avez demandez une r�initialisation de mot de passe.<br>
                                        Voici votre code de r�nitialisation : '.$recup_code.'
                                    </div>
                                </body>
                        </html>
                        ';
                    mail($recup_mail, "R�cup�ration de mot de passe", $message, $headers);
                    header('Location:' .WEBROOT.'email_forgot_old.php?section=code');
                    die();
                }else{
                    setFlash("Cette adresse mail n'existe pas", "danger");
                }
            }
            else{
                setFlash("adresse mail invalide", "danger");
            }
        }else{
            setFlash("Veuillez entrer votre adresse mail", "danger");
        }
}
include "partials/header.php";
?>

    <div class="container center-block vertical-center">
        <h1>Récupération du mot de passe</h1>

        <form action="#" method="post">
            <?php
                if($section == "code"){ ?>
                    Récupération de mot de passe pour <?php echo $_SESSION['recup_mail']?>
                    <div class="form-group ">
                        <label for="text">Code de r�cuperation</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <button type="submit" class="btn btn-success" name="code_submit">Envoyer</button>
                    <button type="submit" class="btn btn-default" >Annuler</button>
                <?php } elseif ($section == 'changepwd'){ ?>
                    Nouveau de mot de passe pour <?php echo $_SESSION['recup_mail']?>
                    <div class="form-group ">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="text" class="form-control" name="change_pwd">

                        <label for="password">Confirmation du nouveau mot de passe</label>
                        <input type="text" class="form-control" name="change_pwd_confirm">
                    </div>
                    <button type="submit" class="btn btn-success" name="pwd_submit">Envoyer</button>
                    <button type="submit" class="btn btn-default" >Annuler</button>
                <?php } else { ?>
                    <div class="form-group ">
                        <label for="email">email</label>
                        <input type="email" class="form-control" name="recup_mail">
                    </div>
                    <button type="submit" class="btn btn-success" name="recup_submit">Envoyer</button>
                    <button type="submit" class="btn btn-default" >Annuler</button>
                <?php } ?>


        </form>
    </div>

<?php include '/partials/footer.php';?>