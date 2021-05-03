<?php 
require_once "entete.php";


if(!empty($_POST["envoie"]) && $_POST["envoie"] == 1)
{
    $SecretPassword = new QuestionSecrete();
    
    $SecretPassword->getQuestionSecretes($_POST["identifiant"]);
    $intitule = $SecretPassword -> getIntitule();
    print_r($intitule);
        ?>
        
        <form method="post" action="../traitements/mdpOublier.php" class="form-group text-center">
            
            <div class="col-md-6">
                <h4><?=$intitule?></h4>
                <label for="identifiant" class="form-label">Saisissez la reponse a votre Question Secrete</label>
                <input type="text" class="form-control" name="rep1" id="rep1">
            </div>
            <div class="col-md-6">
                <label for="mdp" class="form-label">Ressaisissez la reponse a votre Question Secrete</label>
                <input type="text" class="form-control" name="rep2" id="rep2">
            </div>       
            <input type=hidden name="identifiant" value="<?=$_POST["identifiant"];?>"/>     
            <button type="submit" class="btn btn-outline-primary" name="envoie" value="1">Vérifier</button>
        </form>

        <?php
 





}else{
?>
<form method="post" action="../pages/mdpOublier.php">
    <div class="col-md-6">
        <label for="identifiant" class="form-label">Choisissez un identifiant</label>
        <input type="text" class="form-control" name="identifiant" id="identifiant">
    </div>
    
    <button type="submit" class="btn btn-outline-primary" name="envoie" value="1">Connexion</button>
</form>

<?php
}
?>