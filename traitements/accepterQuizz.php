<?php

require_once "../modeles/Modele.php";
// print_r($_POST);

if(!empty($_POST["accepterQuizz"]))
{
    $requete = getBdd() -> prepare("SELECT idQuizz FROM Quizz WHERE idQuizz = ?");
    $requete -> execute([$_POST["accepterQuizz"]]);
    if($requete -> rowCount() == 1)
    {
        $acceptQuizz = new Quizz();
        if($acceptQuizz -> accepterQuizz($_POST["accepterQuizz"]) == true)
        {
            header("location:../pages/admin.php?success=quizzAccepter");
        }
    }
    else
    {
        header("location:../pages/admin.php?error=idQuizz");
    }
}
else
{
    header("location:../pages/admin.php?success=boutonEnvoi");
}