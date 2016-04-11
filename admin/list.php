<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/lib/includes.php");

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

//suppression
if(isset($_GET['delete'])){
    $id = htmlspecialchars($_GET['delete']);
    
    $select = $db->prepare('SELECT * FROM node where id_user=:id_user');
    $select->execute(array(':id_user'=>$id));
    $list = $select->fetch();
    
    $count = $select->rowCount();    
    if($count != 0){
        $req = $db->prepare('UPDATE node SET id_user = 1 WHERE id_user = :id');
        $req->execute(array(
            'id' => $id
        ));
        
        $db->query("delete from user where id=$id");
    }else{
        $db->query("delete from user where id=$id");
    }
    
    
    
    setFlash("Utilisateur supprimer");
    header('Location:' . WEBROOT . 'list.php?token='.$_SESSION['token']);
    die();
}
  
    $select = $db->query("select * from user where new = 1 and id > 1");
    $list_user = $select->fetchAll();

include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>

<div class="container_list ">
    <h1>Liste des Utilisateurs</h1>
    <div class="form-group ">
        <label for="login">Recherche</label>
        <input type="text" class="form-control" id="search" name="search">
    </div>
    
    

    <table class="table table-bordered table-striped"  id="table_list_user">
        <thead>
            <th>Id</th>
            <th>Login</th>
            <th>Nombre d'insertion</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
            </tr>
            <?php foreach ($list_user as $user): ?>
            <tr>
                <td class=""><?php echo $user->id; ?></td>
                <td><?php echo $user->login; ?></td>
                <td><?php echo $user->nb_insert; ?> <a href="detail_user.php?id=<?php echo $user->id?>" class="btn btn-default" name="update">Detail</a></td>
                <td>
                    <a href="admin_update_profile_user.php?id=<?php echo $user->id?>&token=<?php echo $_SESSION['token']?>" class="btn btn-default" name="update">Modifier</a>
                    <a href="?delete=<?= $user->id;?>&token=<?php echo $_SESSION['token']?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php endforeach;?>

        </tbody>
    </table>
</div>

<div class="result" id="result">
                
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/footer.php");
?>