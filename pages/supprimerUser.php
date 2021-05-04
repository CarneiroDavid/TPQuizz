<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT pseudo FROM users WHERE idUser = ?");
$requete -> execute([$_GET["idUser"]]);
$user = $requete -> fetch(PDO::FETCH_ASSOC);
?>

<h2 style="text-align: center;">Voulez-vous vraiment supprimer <?=$user["pseudo"];?></h2>
<div>
<form method="post" action="../traitements/supprimerUser.php">
    <button class="btn btn-warning" style="width: 12%;" type="submit" value="<?=$_GET['idUser'];?>" name="supprimerUser">Oui</button>
</form>
    
    <a class="btn btn-primary" style="width: 12%;" href="admin.php">Non</a>

</div>