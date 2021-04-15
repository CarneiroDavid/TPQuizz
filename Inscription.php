<?php 
require_once "entete.php";
$user = new User();
$listeQuestions = $user -> getQuestionsSecretes();
?>

<form>
    <div class="mb-3">
        <label for="identifiant" class="form-label">Choisissez un identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Saississez votre addresse email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
        <label for="pseudo" class="form-label">Choisissez un pseudo</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo">
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Saisissez votre nom</label>
        <input type="text" class="form-control" name="nom" id="nom">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Saisissez votre prenom</label>
        <input type="text" class="form-control" name="prenom" id="prenom">
    </div>
    <div class="mb-3">
        <label for="mdp" class="form-label">Saisissez votre mot de passe</label>
        <input type="password" class="form-control" name="mdp" id="mdp">
    </div>
    <div class="mb-3">
        <label for="mdp2" class="form-label">Re-saisissez votre mot de passe</label>
        <input type="password" class="form-control" name="mdp2" id="mdp2">
    </div>
    <br>
    <div class="mb-3">
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <?php
            foreach($listeQuestions as $question)
            {
                ?>
                <option value="<?=$question["idQuestionSecrete"];?>"><?=$question["intitule"];?></option>
                <?php
            }
        
        ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="repSecrete" class="form-label">Reponse de la question</label>
        <input type="text" class="form-control" name="repSecrete" id="repSecrete">
    </div>
    <button type="submit" class="btn btn-outline-primary" name="envoie" value="1">Inscription</button>
</form>
<?php

require_once "pied.php";