<?php

include "lib/includes.php";
include "partials/header.php";

include "partials/navbar_user.php";



?>
<div class="container center-block vertical-center">
    <div class="form">
<?php echo "<p> Vous pensez à ".$_SESSION['result']. "</p><br>"; ?>

            <div class="hidden-div" id="hidden-div_oui">
                gagner, <a href="game.php?token=<?php echo $_SESSION['token']?>">On recommence ?</a>
            </div>


            <button onclick="
                getElementById('hidden-div_oui').style.display = 'block';
                this.style.display = 'none';
                getElementById('non').style.display = 'none';
                getElementById('reponse').style.display='none'"
                    id="oui" class="btn btn-success" value="oui" name="oui">Oui
            </button>
       

            <button onclick='document.location.href="form_result.php?token=<?php echo $_SESSION['token']?>";'
                    id="non" class="btn btn-danger" value="non" name="non">Non
            </button>


    </div>
</div>
<?php include 'partials/footer.php';?>
