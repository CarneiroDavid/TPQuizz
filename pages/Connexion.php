<?php
require_once "entete.php";
?>

<form method="post" action="../traitements/Connexion.php">
    <div class="mb-3">
        <label for="identifiant" class="form-label">Choisissez un identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant">
    </div>
    <div class="mb-3">
        <label for="mdp" class="form-label">Saississez votre addresse email</label>
        <input type="password" class="form-control" name="mdp" id="mdp">
    </div>
    
    <button type="submit" class="btn btn-outline-primary" name="envoie" value="1">Connexion</button>
</form>