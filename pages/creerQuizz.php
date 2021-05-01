<?php
require_once "entete.php";
$app = new Application();
$allCat = $app->getAllCat();
?>
<form method="post" action="../traitements/creeQuizz.php" class="form-group">
<label for="Quizz[titre]">Titre</label>
<input type="text" name="Quizz[titre]">
<label for="Quizz[idCategorie]">Catégorie</label>
<select name="Quizz[idCategorie]">
<?php
foreach($allCat as $cat){
    ?>
    <option value="<?=$cat['idCategorie'];?>"><?=$cat['nom'];?></option>
    <?php
}
?>

</select>

<?php
$i=0;

for($i = 1; $i<=11 ; $i++)
{
    
    if($i == 1)
    {
        echo "<div id='question".$i."' style='display:block'>";
        
    }else{
        echo "<div id='question".$i."' style='display:none'>";
        
    }
    if($i != 11){
     echo "<h3>Question ".$i."</h3>";
    }
    if($i!=11){
        ?>
        <label for="Quizz[question][<?=$i?>][titre]">Question :</label>
        <input type="text" name="Quizz[question][<?=$i?>][titre]">
        <br>
        <label for="Quizz[question][<?=$i?>][reponse][1]">Reponse 1 (Vrai)</label>
        <input type="text" name="Quizz[question][<?=$i?>][reponse][1]">
        <br>
        <label for="Quizz[question][<?=$i?>][reponse][2]">Reponse 2 (Faux)</label>
        <input type="text" name="Quizz[question][<?=$i?>][reponse][2]">
        <br>
        <label for="Quizz[question][<?=$i?>][reponse][3]">Reponse 3 (Faux)</label>
        <input type="text" name="Quizz[question][<?=$i?>][reponse][3]">
        <br>
        <label for="Quizz[question][<?=$i?>][reponse][4]">Reponse 4 (Faux)</label>
        <input type="text" name="Quizz[question][<?=$i?>][reponse][4]">
        <br>
        <?php

        if($i>1)
        {
        echo "<button type='button' onclick='precQuestion(".$i.")'>Question Précédente</button>";
        }  
        if($i<11){
        ?>
        <button type='button' onclick="nextQuestion(<?=$i;?>)">Question suivante</button>
        </div>
        <?php
        }
    }
    if($i == 11){
        
        ?>
        <button type='button' onclick="precQuestion(<?=$i;?>)">Question Précédente</button>
        <button type=submit>Enregistrer le quizz</button>
        </div>
        <?php
    }


}
?>
</form>

<?php
require_once "pied.php";