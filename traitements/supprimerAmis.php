<?php
require_once "../modeles/Modele.php";
$suprAmis = new Lier();
// print_r($_POST);
if(!empty($_POST["supprimer"]))
{
    // echo "yo";
    if($suprAmis -> supprimerAmis($_SESSION["idUser"], $_POST["supprimer"]) == true)
    {
        header("location:../pages/listAmis.php?success=amiSupr");
    }
    else
    {
        header("location:../pages/listAmis.php?error=amiSupr");
    }
}
else
{
    header("location:../pages/listAmis.php?error=formulaire");

}