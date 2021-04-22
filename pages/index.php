<?php
require_once "entete.php";
    if(empty($_GET["idCat"]) && empty($_GET["idQuizz"]))
    {
        ?>
        <h2>Categorie</h2></br>
        <div class="container" style="max-width: 75%;margin-left: auto; margin-right: auto">
        <?php
        foreach ($cats as $cate)
        {
            ?>
                
            <div class="col-md-12" style="max-width: 30%;float:left;">
                <div class="card">            
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">
                            <?=$cate["nom"];?>
                        </h5>
                        <a href="index.php?idCat=<?=$cate["idCategorie"];?>" style="text-align:center; width : 100%" class="btn btn-primary">lien</a>
                    </div>
                </div>
            </div>
            <?php
        }
            ?>
        </div>
            <?php
    }
   
    if(!empty($_GET["idCat"]))
    {
        $newCat = new Categorie($_GET["idCat"]);
        $newCat -> recupQuizz($_GET["idCat"]);
        $listQuizz = $newCat -> getListQuizz();
        ?><pre><?php
        // print_r($listQuizz);
        ?></pre>
        <div class="container" style="max-width: 75%;">
        <?php
        foreach($listQuizz as $Quizz)
        {
           ?>   
            <div class="col-md-12" style="max-width: 30%;float:left;">
                <div class="card">            
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">
                            <?=$Quizz -> getTitleQuizz();?>
                        </h5>
                        <a href="index.php?idQuizz=<?=$Quizz -> getIdQuizz();?>" style="text-align:center; width : 100%" class="btn btn-primary">lien</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }
    if(!empty($_GET["idQuizz"]))
    {
        $Quizz = new Quizz($_GET["idQuizz"]);?>
        <pre>
        <?php
        $listQuestion = $Quizz -> getQuestions();
        shuffle($listQuestion);
        // print_r ($listQuestion);
        
        ?></pre><?php
        ?>
            <?php
            $i = 1;
            foreach($listQuestion as $question)
            {
                
                    if($i == 1)
                    {
                        echo "<div id='question".$i."' style='display:block;'>";
                    } 
                    else
                    {
                        echo "<div id='question".$i."' style='display:none;'>";
                    }
                    ?>
                
                    
                        <h1><?=$question ->getTitre();?></h1>
                        <pre>
                        <?php
                        // print_r($question);
                        ?></pre><?php
                        $reps = $question -> getReps();
                        shuffle($reps);
                        foreach($reps as $reponse)
                        {
                            // shuffle($reponse); 
                            ?>
                            <button onclick="nextQuestion(<?=$i;?>,this.value)" value="<?=$reponse -> getIdReponse();?>"><?=$reponse -> getReponse();?></button>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                
                if($i == count($listQuestion))
                {
                    ?>
                    <div id="question<?=$i+1;?>" style="display:none;">
                        <form method="post" action="../traitements/resultat.php">
                    <?php
                    $a = 1;
                        foreach($listQuestion as $x)
                        {
                            ?>
                            <input type="hidden" value="" id="Reponse[<?=$a;?>]" name="Reponse[<?=$x -> getIdQuestion();?>]">
                            
                            <?php
                            $a++;
                        }

                    ?>
                    <input type="hidden" value="<?=$_GET['idQuizz'];?>" id="Reponse[<?=$a;?>]" name="idQuizz">
                    <button type="submit">Voir résultat</button>
                        </form>
                    </div>
                    <?php
                }
                $i++;
            }
            ?>
            
        <?php
    }
require_once "pied.php";
            ?>
            