<?php
require_once "../modeles/Modele.php";
if(!empty($_POST["envoie"]))
{
    $User= new User($_POST["envoie"]);
    if(!empty($_POST["mdp1"]) && !empty($_POST["mdp2"]))
    {
        if($_POST["mdp1"] == $_POST["mdp2"])
        {
            if(strlen($_POST["mdp1"]) > 6 && strlen($_POST["mdp1"]) < 35)
            {
                
                if($User->ChangeMdp($_POST["mdp1"],$User->getIdUser()) == true){
                    header("location:../pages/Connexion.php?success=true");
                }else{
                    ?>
                    <body  onload="load()">
                    <form method="POST" name='form' id='form' action="../pages/reinitMdp.php">
                    <input type="hidden" value="<?=$User->getIdUser();?>" name="UserId"/>
                    <input type="hidden" value="1" name="VerifMdp"/>
                    <input type="hidden" value="BddError" name="erreur"/>
                    </form>
                    </body>
                    <?php
                }
            }else{
                ?>
                <body  onload="load()">
                <form method="POST" name='form' id='form' action="../pages/reinitMdp.php">
                <input type="hidden" value="<?=$User->getIdUser();?>" name="UserId"/>
                <input type="hidden" value="1" name="VerifMdp"/>
                <input type="hidden" value="StrLenErreur" name="erreur"/>
                </form>
                </body>
                <?php
            }
        }else{
            ?>
            <body  onload="load()">
            <form method="POST" name='form' id='form' action="../pages/reinitMdp.php">
            <input type="hidden" value="<?=$User->getIdUser();?>" name="UserId"/>
            <input type="hidden" value="1" name="VerifMdp"/>
            <input type="hidden" value="MdpDifError" name="erreur"/>
            </form>
            </body>
            <?php
        }
    }else{
        ?>
        <body  onload="load()">
        <form method="POST" name='form' id='form' action="../pages/reinitMdp.php">
        <input type="hidden" value="<?=$User->getIdUser();?>" name="UserId"/>
        <input type="hidden" value="1" name="VerifMdp"/>
        <input type="hidden" value="FormVide" name="erreur"/>
        </form>
        </body>
        <?php
    }
}else{
    header("location:../pages/mdpOublier.php");
}
?>
<script>
function load(){
    document.forms['form'].submit()
    document.getElementById("form").submit()
}
</script>