<?php
require_once "entete.php";
$app = new Application();
$allCat = $app->getAllCat();
?>
<h2 style="text-align:center;">Créer ton quizz !</h2>
<div class="container" style="max-width : 75%">
<form method="post" action="../traitements/creeQuizz.php" class="row g-3">

    <div class="col-md-6">
        <label for="Quizz[titre]">Titre</label>
        <input type="text" class="form-control" name="Quizz[titre]">
    </div>
    
    <br>

    <div class="col-md-6">
    <label for="Quizz[idCategorie]">Catégorie</label>
    <select name="Quizz[idCategorie]" class="form-select">
        <?php
        foreach($allCat as $cat)
        {
            ?>
            <option value="<?=$cat['idCategorie'];?>"><?=$cat['nom'];?></option>
            <?php
        }
            ?>

    </select>
    </div>
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
            <input type="text" class="form-control" name="Quizz[question][<?=$i?>][titre]">
            <br>
            <div>
                <div class="col-2.5" style="margin-right:3.5%; float:left;">
                    <label for="Quizz[question][<?=$i?>][reponse][1]">Reponse 1 (Vrai)</label>
                    <input type="text" class="form-control" name="Quizz[question][<?=$i?>][reponse][1]">
                </div>
                
                <div class="col-2.5" style="margin-right:3%;float:left;">
                    <label for="Quizz[question][<?=$i?>][reponse][2]">Reponse 2 (Faux)</label>
                    <input type="text" class="form-control" name="Quizz[question][<?=$i?>][reponse][2]">
                </div>

                <div class="col-2.5" style="margin-right:3%;float:left;">
                    <label for="Quizz[question][<?=$i?>][reponse][3]">Reponse 3 (Faux)</label>
                    <input type="text" class="form-control" name="Quizz[question][<?=$i?>][reponse][3]">
                </div>

                <div class="col-2.5" style="margin-right:3%;float:left;">
                    <label for="Quizz[question][<?=$i?>][reponse][4]">Reponse 4 (Faux)</label>
                    <input type="text" class="form-control" name="Quizz[question][<?=$i?>][reponse][4]">
                </div>
            </div>
            <br>
            <br><br><br><br>
            <?php

            if($i>1)
            {
            echo "<button type='button' class='btn btn-primary' onclick='precQuestion(".$i.")'>Question Précédente</button>";
            }  
            if($i<11){
            ?>
            <br>
            <button type='button'class="btn btn-primary" onclick="nextQuestion(<?=$i;?>)">Question suivante</button>
            </div>
            <?php
            }
        }
        if($i == 11){
            
            ?>
            <button type='button' class="btn btn-primary" onclick="precQuestion(<?=$i;?>)">Question Précédente</button>
            <button type=submit class="btn btn-primary">Enregistrer le quizz</button>
            </div>
            <?php
        }


    }
    ?>
</form>
</div>

<?php
require_once "pied.php";