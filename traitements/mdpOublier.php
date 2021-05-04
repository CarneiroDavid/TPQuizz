<?php
require_once "../modeles/Modele.php";
?>
<pre>
<?php
print_r($_POST);
?>
</pre>
<?php

if(!empty($_POST["rep1"]) && !empty($_POST["rep2"]) && !empty($_POST["identifiant"]))
{
    if($_POST["rep1"] == $_POST["rep2"])
    {
        $requete = getBdd()->prepare("SELECT idUser from Users Where identifiant = ?");
        $requete->execute([$_POST["identifiant"]]);
        if($requete-> rowCount() == 1 ){
            $idUser = $requete->fetch(PDO::FETCH_ASSOC);
            $User = new User($idUser["idUser"]);
            $reponseS = $User->getReponseSecrete();

            if($_POST["rep1"] == $reponseS){
                ?>
                <body  onload="load()">
                <form method="POST" name='form' id='form' action="../pages/reinitMdp.php"">
                <input type="hidden" value="<?=$User->getIdUser();?>" name="UserId"/>
                <input type="hidden" value="1" name="VerifMdp"/>

                </form>
                </body>
                <?php
            }else{
                $erreur = "La reponse a la question secrete ne correspond pas";
                echo $erreur;
                header("location:../pages/mdpOublier.php?erreur=$erreur");
            }
        }else{
            $erreur = "L'identifiant saisit n'existe pas.";
            echo $erreur;
            header("location:../pages/mdpOublier.php?erreur=$erreur");
        }
    }else{
        $erreur = "La vérification de la reponse n'est pas identique";
        echo $erreur;
        header("location:../pages/mdpOublier.php?erreur=$erreur");
    }
}
?>
<script>
function load(){
    document.forms['form'].submit()
    document.getElementById("form").submit()
}
</script>