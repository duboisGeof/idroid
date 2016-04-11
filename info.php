<?php
$auth=0;
include "lib/includes.php";

include "partials/header.php";
include "partials/navbar_user.php"
?>


<div class="info">
    <h1 class="info">Bienvenue sur Idroid !</h1>
    
    <p class="info">Idroid est une copie du célébre jeu <a href="http://fr.akinator.com/">Akinator</a>. Il a pour objectif de trouver la personne auquelle l'on pense ! </p>
    <p class="info">
        Le principe du jeu est évolutif, cela veut dire que pour l'instant le programme est en phase d'apprentissage, il n'a qu'une dizaine de personne en mémoire. Il ne trouvera certainement pas la personne auquelle vous pensiez  <strong>mais plus vous allez jouer, plus il va apprendre</strong>.
        Toutes les nouvelles informations seront stockées dans sa base de donnée et la prochaine fois que vous allez pensez à la même personne, vous n'allez plus pouvoir le piéger.
    </p>
    
    <p>
        Le programme à donc besoin de votre contribution pour évoluer <strong>et devenir presque imbattable au fil des parties !</strong>
    </p>
</div>


<?php
include "partials/footer.php";
?>