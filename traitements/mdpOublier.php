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
    if($_POST["rep1"] == $_POST["rep1"])
    {
        $requete->getBdd()->prepare("SELECT idUser from Users Where identifiant = ?");
        $requete->execute([$_POST["identifiant"]]);
        $idUser = $requete->fetch(PDO::FETCH_ASSOC);
        $User = new User($idUser["idUser"]);
        $reponseS = $User->getReponseSecrete();

        if($_POST["rep1"] == $reponseS){
            echo "hmm";
        }else{
            echo "mmh";
        }

    }
}