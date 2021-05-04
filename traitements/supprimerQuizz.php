<?php
require_once "../modeles/Modele.php";
$supprQuizz = new Quizz($_POST["boutonSuppr"]);
?><pre>
<?php
// print_r($_POST);
// print_r($supprQuizz);

?></pre><?php
if(!empty($_POST["boutonSuppr"]))
{
    if($supprQuizz -> supprimerQuizz($_POST["boutonSuppr"]) == true)
    {
        if($supprQuizz -> getQuestions()[1] -> supprimerQuestion($_POST["boutonSuppr"]) == true)
        {
            if($supprQuizz -> getQuestions()[1] -> getReps()[1] -> supprimerReponse($_POST["boutonSuppr"]) ==true)
            {
                header("location:../pages/admin.php?success=quizzSuppr");

            }
            else
            {
                header("location:../pages/admin.php?error=supprimerReponse");

            }
        }
        else
        {
            header("location:../pages/admin.php?error=supprimerQuestion");

        }
    }
    else
    {
        header("location:../pages/admin.php?error=supprimerQuizz");
    }
}
else
{
header("location:../pages/admin.php?error=boutonSuppr");
}