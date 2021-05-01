<?php
// require_once "../pages/entete.php";
require_once "../modeles/Modele.php";
$refusDemandeAmis = new Lier();
print_r($_POST);
if(!empty($_POST["refuser"]))
{
    echo "yo";
    if($refusDemandeAmis -> refuserAmis($_POST["refuser"], $_SESSION["idUser"]) == true)
    {
        // header("location:../pages/listAmis.php?success=amisAccepter");
    }
    else
    {
        // header("location:../pages/listAmis.php?error=amisAccepter");
    }
}
else
{
    // header("location:../pages/listAmis.php?error=formulaire");

}