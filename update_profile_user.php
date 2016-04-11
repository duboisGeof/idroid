<?php
include "lib/includes.php";


if($_SESSION['login'] == ""){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

$select = $db->query("select * from user");
$list_user = $select->fetchAll();

/**<?php echo $user->id; ?>**/

if(isset($_POST['login']) || isset($_POST['password']) && isset($_SESSION['token'])){
    $login = str_replace("'", "",  $db->quote($_POST['login']));
    $pwd = sha1($_POST['password']);

    $req = $db->prepare('UPDATE user SET login= :login, password= :password WHERE id= :id');
    $req->execute(array(
        'id' => $_SESSION['id'],
        'login' => $login,
        'password' => $pwd
    ));

    if($req){
        setFlash("La mise a jour a bien ete effectuee");
    }
}
include "partials/header.php";
include "partials/navbar_user.php";
?>



    <div class="container center-block vertical-center">
        <h1>Modifier vos informations</h1>

        <form action="#" method="post">
            <div class="form-group ">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" value="<?php echo $_SESSION['login']; ?>">
            </div>

            <div class="form-group ">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['pwd']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
            <button type="submit" class="btn btn-default">Annuler</button>

        </form>
    </div>

<?php include '/partials/footer.php';?>