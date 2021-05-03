<?php
require_once "entete.php";
$quizzs = new Application();
$listQuizz = $quizzs -> getAllQuizz();
// print_r($listQuizz);

?>
<h2>Quizz</h2>
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
                if($quizz["statut"] != "attente")
                {
                    echo "<input type='checkbox' id='scales' name='scales' checked>";
                }
                else
                {
                    echo "<a href='admin.php?idQuizz=$quizz[idQuizz]'>Verifier le quizz</a>";
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
    <br><br><br><br>
    <form method="post" action="admin.php">
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
                <label for="question<?=$i;?>">Question <?=$i;?></label>
                <input type="text" class="form-control" name="question" value="<?=$question -> getTitre();?>"><br>
                <div style="color:blue">
                    <?php
                    foreach($reps as $reponse)
                    {
                        
                        ?>
                        <div class="col-2.5" style="margin-right:3.5%; float:left;">
                            <label for="rep1">Réponse <?=$x;?> <?=$x == 1 ? "(Vrai)" : "(Faux)";?></label>
                            <input type="text" class="form-control" name="Quizz[question][<?=$i;?>][reponse][<?=$x;?>]" value="<?=$reponse -> getReponse();?>">
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
   </form>
<?php

}
?>