<?php
require_once "entete.php";
require_once "pied.php";
?>

    <!-- <div> -->
        <h1>Titre du Quizz : <?php echo $quizz -> getTitleQuizz();?></h1>
        <h1>ID de la catégorie : <?php echo $quizz -> getCat() -> getIdCat();?></h1>
        <h1>ID de la premiere question : <?php echo $quizz -> getQuestions()[0] -> getIdQuestion();?></h1>
        <h1>Titre de la premiere question : <?php echo $quizz -> getQuestions()[0] -> getTitre();?></h1>
        <h1>Titre de la premiere réponse de la premiere question<?php echo $quizz -> getQuestions()[0] -> getReps()[0] -> getReponse();?></h1>
        <h1>Information de la premiere réponse de la premiere question : <?php echo $quizz -> getQuestions()[0] -> getReps()[0] -> getVerification();?></h1>
    <!-- </div> -->


    


    <?php 
    foreach($David->getUser() as $info)
    {
        echo $info;
    }
    ?>
