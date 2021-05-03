<?php
require_once "entete.php";
$quizzs = new Application();
$listQuizz = $quizzs -> getAllQuizz();
?><pre><?php
// print_r($_POST);
?></pre><?php

?>
<h2 style="text-align: center;">Quizz</h2>
<?php
foreach($listQuizz as $quizz)
{
    ?>
    <div class="col-md-12" style="max-width:25%;float:left;" >
        <div class="card" style="height:12%;max-height:12%;">            
            <div class="card-body">
                <h5 class="card-title" style="text-align: center;">
                    <?=$quizz["Titre"];?>
                </h5>
                <?php
                if($quizz["statut"] == "attente")
                {
                    echo "<a href='admin.php?idQuizz=$quizz[idQuizz]'>Verifier le quizz</a>";
                    ?>
                    <form method="post" action="../traitements/supprimerQuizz.php">
                        <button type="submit" value="<?=$quizz["idQuizz"];?>" class="btn btn-success">Accepter</button>
                    </form>
                        <a href="supprimerQuizz?idQuizz=<?=$quizz['idQuizz'];?>&Quizz=<?=$quizz['Titre'];?>">Supprimer</a>
                    <?php
                }
                
                ?>
                
            </div>
        </div>
    </div>
    <?php
}


if(!empty($_GET["idQuizz"]))
{
    $quizz = new Quizz($_GET["idQuizz"]);
    ?>
    <br><br><br><br><br>
    <form method="post" action="../traitements/creeQuizz.php">
        <div class="col-md-6">
            <label for="Quizz[titre]">Titre du quizz</label>
            <input type="text" class="form-control" name="Quizz[titre]" value="<?=$quizz -> getTitreQuizz();?>">
            <input type="hidden" class="form-control" name="Quizz[action]" value="modifier">
            <input type="hidden" class="form-control" name="Quizz[idQuizz]" value="<?=$_GET['idQuizz'];?>">
        </div>
        <div class="col-md-6">
            <label for="Quizz[idCategorie]">Catégorie</label>
            <select name="Quizz[idCategorie]" class="form-select">
            <?php
            foreach($cats as $cat)
            {
                ?>
                <option value="<?=$cat['idCategorie'];?>"><?=$cat['nom'];?></option>
                <?php
            }
                ?>

            </select>
        </div>
        <!-- <pre> -->
        <?php 
        // print_r($questions);
        ?>
        <!-- </pre> -->
        <?php
        $i = 1;
        
        foreach($quizz -> getQuestions() as $question)
        {   
            $x = 1;
            $reps = $question -> getReps();
            ?>
            <pre>
            <?php 
            // print_r($reps);
            ?>
            </pre>
            <?php
            ?>
            <div>
                <div class="col-md-9">
                    <label for="question<?=$i;?>">Question <?=$i;?></label>
                    <input type="text" class="form-control" name="Quizz[question][<?=$question -> getIdQuestion();?>][titre]" value="<?=$question -> getTitre();?>">
                    
                </div>
                <br>
                <div style="color:blue">
                    <?php
                    foreach($reps as $reponse)
                    {
                        
                        ?>
                        <div class="col-2.5" style="margin-right:3.5%; float:left;">
                            <label for="rep1">Réponse <?=$x;?> <?=$x == 1 ? "(Vrai)" : "(Faux)";?></label>
                            <input type="text" class="form-control" name="Quizz[question][<?=$question -> getIdQuestion();?>][reponse][<?=$reponse -> getIdReponse();?>]" value="<?=$reponse -> getReponse();?>">
                        </div>
                        <?php
                        $x++;
                    }
                        ?>
                </div>
            </div>
                <br><br><br>
            <?php
            $i++;
        }
        ?>
        <button type="submit" name="button" value="">Envoyer</button>
   </form>
<?php

}
?>