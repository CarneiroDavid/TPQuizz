<?php
// require_once "../pages/entete.php";
require_once "../modeles/Modele.php";
$insert = new Lier();
?><pre><?php
print_r($_POST);
?></pre><?php
if(!empty($_POST["bouton"]) && $_POST["bouton"] ==1)
{
    if(!empty($_POST["idReceveur"]))
    {
        $requete = getBdd() -> prepare("SELECT idUser FROM users WHERE idUser = ?");
        $requete -> execute([$_POST["idReceveur"]]);
        if($requete -> rowCount() == 1)
        {
            $requete = getBdd() -> prepare("SELECT idUser FROM users WHERE idUser = ?");
            $requete -> execute([$_POST["idEnvoyeur"]]); 
            if($requete -> rowCount() == 1)
            {
                if($insert -> insertion($_SESSION["idUser"], $_POST["pseudoEnvoyeur"], $_POST["idReceveur"]) == true)
                {
                    header("location:../pages/listAmis.php?success=demandeEnvoyer");
                }
                else
                {
                    header("location:../pages/listAmis.php?error=demandeEnvoyer");
                }
            }
            else
            {
                header("location:../pages/listAmis.php?error=userEnvoyeur");
            }
        }
        else
        {
            header("location:../pages/listAmis.php?error=userReceveur");
        }
    }
    else
    {
        header("location:../pages/listAmis.php?error=userVide");
    }
}
else
{
    header("location:../pages/listAmis.php?error=formNonEnvoyer");
}


