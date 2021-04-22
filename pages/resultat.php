<?php
require_once "entete.php";
?>
<pre>
<?php
print_r($_POST);
?></pre>
<?php
if(!empty($_POST))
{
    extract($_POST);

    foreach($Reponse as $idQuestion => $reponse)
    {
        $select = new Selectionner();
        $select -> initialiserSelectionner($_SESSION["idUser"], $reponse, $idQuestion, $idQuizz);
        $select -> insertion();
    }
}