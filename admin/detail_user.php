<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/lib/includes.php");

if($_SESSION['level'] !=0){
    header('Location:' . WEBROOT . 'logout.php');
    die();
}

$id = $_GET['id'];
$sql = "select node.questions, node.results, node.id, user.login from node inner join user on node.id_user = user.id where node.id_user='$id' ORDER BY date_insert ASC";

$select = $db->query($sql);
$req = $select->fetchAll();

$select_login = $db->prepare('SELECT login FROM user where id=:id');
$select_login->execute(array(':id'=>$_GET['id']));
$login = $select_login->fetch(PDO::FETCH_OBJ);


include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/header.php");
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/navbar_admin.php");
?>

    <div class="container_list ">
        <h1>Liste des modification fait par <?php echo $login->login; ?></h1>

        <table class="table table-bordered table-striped">
            <thead>
                <th>Question insérée</th>
                <th>Réponse insérée</th>
            </thead>
            <tbody>
            <?php $count=0?>
            <?php foreach ($req as $r): ?>
                <tr>
                    <td class=""><?php echo $r->questions; ?></td>
                    <td class=""><?php echo $r->results; ?></td>
                    <?php $count++;
                        if($count%3 ==0){
                           ?>
                                <tr class="blank">
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>



<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/partials/footer.php");
?>