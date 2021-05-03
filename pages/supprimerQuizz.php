<?php
require_once "entete.php";
?>

<h2 style="text-align: center;">Voulez-vous vraiment supprimer le quizz <?=$_GET["Quizz"];?></h2>
<div>
<form method="post" action="../traitements/supprimerQuizz.php">
    <button class="btn btn-warning" style="width: 12%;" type="submit" value="<?=$_GET['idQuizz'];?>" name="bouttonSuppr">Oui</button>
</form>
    
    <a class="btn btn-primary" style="width: 12%;" href="admin.php">Non</a>

</div>
