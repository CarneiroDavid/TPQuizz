<?php
require_once "entete.php";
if(!empty($_POST["UserId"])){
    if(!empty($_POST["erreur"])){
        ?>
        <div class="alert alert-danger text-center"><h6>
        <?php
        switch($_POST["erreur"]){
            case "BddError":
                echo "Erreur lors de la modification.";
                break;
            case "StrlenError":
                echo "Le mot de passe doit contenir entre 6 et 35 caractères.";
                break;
            case "MdpDifError":
                echo "Les deux mot de passes saisit ne sont pas identique.";
                break;
            case "FormVide":
                echo "Formulaire envoyer vide.";
                break;
        }
        ?>
        </div></h6>
        <?php
    }
?>
    <form method="post" action="../traitements/reinitMdp.php">
    <div class="col-md-6">
        <label for="identifiant" class="form-label">Saississez un nouveau mot de passe</label>
        <input type="password" class="form-control" name="mdp1" id="mdp1">
    </div>
    <div class="col-md-6">
        <label for="mdp" class="form-label">Saississez a nouveau votre nouveau mot de passe</label>
        <input type="password" class="form-control" name="mdp2" id="mdp2">
    </div>  
    <button type="submit" class="btn btn-outline-primary" name="envoie" value="<?=$_POST["UserId"];?>">Connexion</button>
</form>
<?php


}

