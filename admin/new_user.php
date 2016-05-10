<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/lib/includes.php");

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}


//validation
if(isset($_GET['valid'])){
    $id = $db->quote($_GET['valid']);
    $db->query("UPDATE user set new = 1 where id=$id");
    setFlash("Utilisateur Valider");
    header('Location:' . WEBROOT . 'list.php?token='.$_SESSION['token']);
    die();
}

//suppression
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("delete from user where id=$id");
    setFlash("Utilisateur supprimer");
    header('Location:' . WEBROOT . 'list.php?token='.$_SESSION['token']);
    die();
}

$select = $db->query("select * from user where new = 0");
$list_user = $select->fetchAll();

include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>

<div class="col-xs-12 col-sm-12 col-lg-12 ">
    <h1>Liste des nouveaux Utilisateurs</h1>

    <table class="table table-bordered table-striped"  id="table_new_user">
        <thead>
            <th>Id</th>
            <th>Login</th>
            <th>Nombre d'insertion</th>
            <th>Action</th>
        </thead>
        <tbody id="tbody">
            
        <?php 
        if($_SESSION['count'] != 0){

             foreach ($list_user as $user): ?>
            <tr id="tr">
                    <td class=""><?php echo $user->id; ?></td>
                    <td><?php echo $user->login; ?></td>
                    <td><?php echo $user->nb_insert; ?> <a href="detail_user.php?id=<?php echo $user->id?>" class="btn btn-default" name="update">Detail</a></td>
                    <td>
                        <a href="?delete=<?= $user->id;?>&token=<?php echo $_SESSION['token']?>" class="btn btn-danger action">Supprimer</a>
                        <a href="?valid=<?= $user->id;?>&token=<?php echo $_SESSION['token']?>" class="btn btn-success action">Valider</a>
                    </td>
                </tr>
        <?php endforeach;
        }else{ ?>
            <td class="" colspan="12">Aucun Résultat</td>
        <?php    
        }
        ?>
           
            
        </tbody>
    </table>
</div>

<div class="result" id="result">
                
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/footer.php");
?>