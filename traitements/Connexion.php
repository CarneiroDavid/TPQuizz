<?php
require_once "../modeles/Modele.php";
$user = new User();
$x = new Modele();
$y = $x -> getBdd();
$requete = $y -> prepare("SELECT identifiant FROM users WHERE identifiant = ?");
$requete -> execute([$_POST["identifiant"]]);
// $id = $requete -> fetch(PDO::FETCH_ASSOC);


if(!empty($_POST["envoie"]) && $_POST["envoie"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["mdp"]))
    {
        if($requete -> rowCount() > 0)
        {
            if($user -> connexion($_POST["identifiant"], $_POST["mdp"]) == true)
            {
                header("location:../pages/index.php?success=reussi");
            }
            else
            {
                header("location:../pages/Connexion.php?error=Mdp");
            }   
        }
        else
        {
            header("location:../pages/Connexion.php?error=IdFaux");
        }
    }
    else
    {
        header("location:../pages/Connexion.php?error=IdMdpVide");
    }
}
else
{
    header("location:../pages/Connexion.php?error=Inscription");
}