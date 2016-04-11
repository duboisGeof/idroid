<?php
include($_SERVER["DOCUMENT_ROOT"] . "/idroid/lib/db.php");

$counting = $db->query('SELECT * FROM user where new = 0');
$count = $counting->rowCount();
$_SESSION['count'] = $count;


?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="login.php" class="navbar-brand"> Idroid</a>
            <?php 
                if(isset($_SESSION['login'])){
                    
                   
                    ?>  <span class="no_click"><?php echo "Bienvenue " . $_SESSION['login'] ?></span> <?php
                }
            ?>

            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                <li><a href=<?php ($_SERVER["DOCUMENT_ROOT"] . "/idroid/")?>"new_user.php"><span id="count"><?php echo $count ?></span> Nouveau Utilisateur</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilisateur <b class="caret"></b> </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?php ($_SERVER["DOCUMENT_ROOT"] . "/idroid/")?>"add_user.php?token=<?php echo $_SESSION['token']?>">Ajouter</a></li>
                        <li><a href=<?php ($_SERVER["DOCUMENT_ROOT"] . "/idroid/")?>"list.php?token=<?php echo $_SESSION['token']?>">Liste des utilisateurs</a></li>
                    </ul>
                </li>
                <li><a href="../logout.php">Se deconnecter</a></li>
            </ul>
        </div>
    </div>
</nav>

