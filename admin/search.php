<?php
$auth=0;
include "../lib/includes.php";

 if(isset($_GET['motclef'])){
    $motclef = $_GET['motclef'];
    $sql = "select * from user WHERE login like '%$motclef%'";
    
    $select = $db->query($sql);
    $results = $select->fetchAll();
        if($select->rowCount()>0){
            ?> 
            <table class="table table-bordered table-striped">
        <thead>
            <th>Id</th>
            <th>Login</th>
            <th>Nombre d'insertion</th>
            <th>Action</th>
        </thead>
        <tbody> <?php
            foreach ($results as $r): ?>
            
             <tr>
                <td class=""><?php echo $r->id; ?></td>
                <td><?php echo $r->login; ?></td>
                <td><?php echo $r->nb_insert; ?> <a href="detail_user.php?id=<?php echo $r->id?>" class="btn btn-default" name="update">Detail</a></td>
                <td>
                    <a href="admin_update_profile_user.php?id=<?php echo $r->id?>&token=<?php echo $_SESSION['token']?>" class="btn btn-default" name="update">Modifier</a>
                    <a href="?delete=<?= $r->id;?>&token=<?php echo $_SESSION['token']?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            
            
            <?php
               
            endforeach;
        }
       else{
            echo "Aucun résultat";
        }
    
        
    }
   
?>
