<?php
require_once "../modeles/Modele.php";
$supprQuizz = new Quizz($_POST["boutonSuppr"]);
?><pre>
<?php
print_r($_POST);
print_r($supprQuizz);

?></pre><?php
if(!empty($_POST["bouttonSuppr"]))
{
    if($supprQuizz -> supprimerQuizz($_POST["bouttonSuppr"]) != true)
    {
        if($supprQuestion -> supprimerQuestion($_POST["bouttonSuppr"]) != true)
        {
            // if($supprReponse -> supprimerReponse($_POST["bouttonSuppr"]) ==true)
            // {
            //     // header("location:admin.php?success=quizzSuppr");

            // }
            // else
            // {
            //     // header("location:admin.php?error=supprimerReponse");

            // }
        }
        else
        {
            // header("location:admin.php?error=supprimerQuestion");

        }
    }
    else
    {
        // header("location:admin.php?error=supprimerQuizz");
    }
}
else
{
// header("location:admin.php?error=boutonSuppr");
}