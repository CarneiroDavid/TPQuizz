<?php
require_once "../modeles/Modele.php";
$supprUser = new User();
// print_r($_POST);
if(!empty($_POST["supprimerUser"]))
{
    $requete = getBdd() -> prepare("SELECT idUser FROM users WHERE idUser = ?");
    $requete -> execute([$_POST["supprimerUser"]]);
    if($requete -> rowCount() == 1)
    {
        if($supprUser -> supprimerUser($_POST["supprimerUser"]) == true)
        {
            header("location:../pages/admin.php?success=userSuppr");
        }
        else
        {
            header("location:../pages/admin.php?error=userSuppr");
        }
    }
    else
    {
        header("location:../pages/admin.php?error=userInexistant");
    }
}
else
{
    header("location:../pages/admin.php?error=formulaire");

}