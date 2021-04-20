<?php
require_once "entete.php";
    if(empty($_GET["idCat"]))
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

        ?>
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
                        <a href="index.php?idQuizz=" style="text-align:center; width : 100%" class="btn btn-primary">lien</a>
                    </div>
                </div>
            </div>
            <?php
            // echo $Quizz -> getQuestions();
        }
        ?>
        </div>
        <?php
    }
require_once "pied.php";
            ?>
            