<?php
require_once "../pages/entete.php";
$idDesQuestion = [];
$listeReponse = [];
?>
<pre>
<?php
print_r($_POST);
?></pre>
<?php
if(!empty($_POST))
{
    $requete = getBdd() -> prepare("SELECT idQuizz FROM quizz WHERE idQuizz = ?");
    $requete -> execute([$_POST["idQuizz"]]);

    // print_r($requete);
    if($requete -> rowCount() > 0)
    {
        
        extract($_POST);
        $idDesQuestion[] = $_POST["idQuizz"];
        foreach($Reponse as $idQuestion => $reponse)
        {
            $idDesQuestion[] = $idQuestion;
            $listeReponse[] = $idQuestion;
            $listeReponse[] = $reponse;
        } 
        $requete = getBdd() -> prepare("SELECT idQuestion FROM questions WHERE idQuizz = ? AND idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ?");
        $requete -> execute($idDesQuestion);

        if($requete -> rowCount() == 10)
        {
            $requete = getBdd() -> prepare("SELECT idQuestion, idReponse, verification FROM reponses WHERE (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?) OR (idQuestion  = ? AND idReponse = ?)");
            $requete -> execute($listeReponse);
            if($requete -> rowCount() == 10)
            {
                $verif = $requete -> fetchAll(PDO::FETCH_ASSOC);
                ?><pre><?php
                // print_r($listeReponse);
                // print_r($verif);
                ?></pre><?php
                $i =0;
                $resultat = [];
                foreach($verif as $x)
                {
                    ?><pre><?php
                    print_r($x);
                    ?></pre><?php
                    if($x["verification"] == "Vrai")
                    {
                        $resultat[] = "La question ".$x["idQuestion"]." est vraie";
                        $i++;
                    }
                }
                echo $i;
                foreach ($resultat as $result)
                {
                    echo $result;
                }

                if(!empty($_SESSION["idUser"]))
                {
                    foreach($Reponse as $idQuestion => $reponse)
                    {
                        $select = new Selectionner();
                        $select -> initialiserSelectionner($_SESSION["idUser"], $reponse, $idQuestion, $idQuizz);
                        $select -> insertion();
                    }
                }
                else
                {

                }
                
            }
            else
            {

            }
            
        }
        else 
        {

        }
        
    }
    else
    {

    }
}
else
{

}