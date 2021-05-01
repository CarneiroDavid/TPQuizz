<?php
require_once "../modeles/Modele.php";
$ajoutAmis = new Lier();
print_r($_POST);
if(!empty($_POST["accepter"]))
{
    // echo "yo";
    if($ajoutAmis -> accepterAmis($_POST["accepter"], $_SESSION["idUser"]) == true)
    {
        header("location:../pages/listAmis.php?success=amisAccepter");
    }
    else
    {
        header("location:../pages/listAmis.php?error=amisAccepter");
    }
}
else
{
    header("location:../pages/listAmis.php?error=formulaire");
}

if(!empty($_POST["refuser"]))
{
    // echo "yo";
    if($ajoutAmis -> refuserAmis($_POST["refuser"], $_SESSION["idUser"]) == true)
    {
        header("location:../pages/listAmis.php?success=amisRefuser");
    }
    else
    {
        header("location:../pages/listAmis.php?error=amiRefuser");
    }
}
else
{
    header("location:../pages/listAmis.php?error=formulaire");

}

if(!empty($_POST["bloquer"]))
{
    // echo "yo";
    if($ajoutAmis -> bloquerAmis($_POST["bloquer"], $_SESSION["idUser"]) == true)
    {
        header("location:../pages/listAmis.php?success=amisBloquer");
    }
    else
    {
        header("location:../pages/listAmis.php?error=amiBloquer");
    }
}
else
{
    header("location:../pages/listAmis.php?error=formulaire");

}