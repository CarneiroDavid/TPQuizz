<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT titre FROM quizz WHERE idQuizz = ?");
$requete -> execute([$_GET["idQuizz"]]);
$idQuizz = $requete -> fetch(PDO::FETCH_ASSOC);
?>

<h2 style="text-align: center;">Voulez-vous vraiment supprimer le quizz <?=$idQuizz["titre"];?></h2>
<div>
<form method="post" action="../traitements/supprimerQuizz.php">
    <button class="btn btn-warning" style="width: 12%;" type="submit" value="<?=$_GET['idQuizz'];?>" name="boutonSuppr">Oui</button>
</form>
    
    <a class="btn btn-primary" style="width: 12%;" href="admin.php">Non</a>

</div>
