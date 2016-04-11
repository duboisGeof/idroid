<?php
include "../../lib/includes.php";

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}



$select = $db->query("select * from user");
$list_user = $select->fetchAll();

$id = $_GET['id'];
$select2  = $db->query('SELECT * FROM user WHERE id="'.$id.'"');
$req = $select2->fetch();

if($select2->rowCount()>0){
    $_SESSION['user_login'] = $req->login;
    $_SESSION['user_pwd'] = $req->password;
}

if(isset($_POST['login']) || isset($_POST['password'])){
    $login = str_replace("'", "",  $db->quote($_POST['login']));
    $pwd = sha1($_POST['password']);

    $req = $db->prepare('UPDATE user SET login= :login, password= :password WHERE id= :id');
    $req->execute(array(
        'id' => $id,
        'login' => $login,
        'password' => $pwd
    ));

    if($req){
        setFlash("La mise a jour a bien ete effectuee");
    }
}

$test = $_GET['id'];

include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>



    <div class="container center-block vertical-center">
        <form action="#" method="post">
            <div class="form-group ">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" value="<?php echo $_SESSION['user_login']; ?>">
            </div>

            <div class="form-group ">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['user_pwd']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
            <button type="submit" class="btn btn-default">Annuler</button>

        </form>
    </div>


<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/footer.php");
?>