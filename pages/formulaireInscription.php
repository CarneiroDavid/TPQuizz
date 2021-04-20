<?php
require_once "entete.php";
$Questions = new QuestionSecrete();
$allQuestion = $Questions -> getQuestionsSecretes();
print_r($_POST);
?>
<div class="container" style="max-width : 75%">
    <form class="row g-3" method="post" action="../traitements/Inscription.php">
        <div class="col-md-6">
            <label for="idetifiant" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="identifiant" name="identifiant">
        </div>
        <div class="col-md-6">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo">
        </div>
        <div class="col-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="col-6">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="col-md-6">
            <label for="mdp" class="form-label">Saisissez votre mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
        <div class="col-md-6">
            <label for="mdp2" class="form-label">Re-Saisissez votre mot de passe</label>
            <input type="password" class="form-control" id="mdp2" name="mdp2">
        </div>
        <div class="col-md-12">
        <label for="questionSecrete" class="form-label">Question Secrete</label>
        <select id="questionSecrete" name="questionSecrete" class="form-select">
            <option selected>Choissisez une question à répondre</option>
            <?php
            foreach($allQuestion as $quest)
            {
                ?>
                <option value="<?=$quest["idQuestionSecrete"];?>"><?=$quest["intitule"];?></option>
                <?php
            }
            ?>
        </select>
        </div>
        <div class="col-md-12">
            <label for="repQuestion" class="form-label">Réponse de la question</label>
            <input type="text" class="form-control" id="repQuestion" name="repQuestion">
        </div>
        <div class="col-12">
            <button type="submit" name="envoi" value="1" class="btn btn-primary">Inscription</button>
        </div>
    </form>
</div>