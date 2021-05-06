<?php
require_once "entete.php";
print_r($_POST);

if(!empty($_GET["idUser"]))
{
    $user = new User($_GET["idUser"]);
    ?>
    <h2 style="text-align: center;">Profil de <?=$user -> getPseudo();?></h2>
    <div class="row g-3">
        <div class="col-md-6">
            <label calss="form-label">Identifiant</label>
            <p class="form-control" name="identifiant"><?=$user -> getIdentifiant();?></p>
        </div>
        <div class="col-md-6">
            <label calss="form-label">Pseudo</label>
            <p type="text" class="form-control"><?=$user -> getPseudo();?></p>
        </div>
        <div class="col-md-6">
            <label calss="form-label">Nom</label>
            <p type="text" class="form-control" name="nom"><?=$user -> getNom();?></p>
        </div>
        <div class="col-md-6">
            <label calss="form-label">Prenom</label>
            <p type="text" class="form-control" name="prenom"><?=$user -> getPrenom();?></p>
        </div>
        <div class="col-md-12">
            <label calss="form-label">Email</label>
            <p type="text" class="form-control" name="email"><?=$user -> getEmail();?></p>
        </div>
        
            <form method="post" action="profil.php">
                <button type="submit" class="form-control" name="idUserAmi" value="<?=$_GET["idUser"];?>">Consulter la liste d'ami</button>
                <button type="submit" class="form-control" name="idUserQuizz" value="<?=$_GET["idUser"];?>">Consulter la liste des scores</button>
            </form>
        </div>
    </div>
    <?php
}

if(!empty($_POST["idUserAmi"]))
{
    $user = new User($_POST["idUserAmi"]);
    ?>
    <h2 style="text-align: center;">Liste d'ami de <?=$user -> getPseudo();?></h2>
    <?php
    $user = new Lier();
    $listAmis = $user ->recupListAmi($_POST["idUserAmi"]);
    ?>
    <div>
        <ul class="list-group">
            <?php
                foreach($listAmis as $ami)
                {
                    ?>
                      <li class="list-group-item"><?=$ami["pseudo"];?></li>
                    <?php
                }
            ?>
        </ul>
    </div>
    <?php
}

if(!empty($_POST["idUserQuizz"]))
{
    $user = new User($_POST["idUserQuizz"]);
    ?>
    <h2 style="text-align: center;">Liste des scores de <?=$user -> getPseudo();?></h2>
    <?php
    $Score = new Score();
    $scores = $Score ->recupScore($_POST["idUserQuizz"]);
    print_r($scores);
    ?>
    <div>
        <ul class="list-group">
            <?php
                foreach($scores as $score)
                {
                    ?>
                    <li class="list-group-item">
                    Quizz "<?=$score["Titre"];?>" : <?=$score["Score"];?>
                        <form method="post" action="profil.php">
                            <input type="hidden" name="idQuizz" value="<?=$score["idQuizz"];?>">
                            <button type="submit" value="<?=$score["idUser"];?>" name="idUser">Verifier les résultats</button>
                        </form>
                        <!-- <a href="profil.php?idQuizz=" -->
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>
    <?php
}

if(!empty($_POST["idUser"]) && !empty($_POST["idQuizz"]))
{
    $idDesQuestion = [];
    // print_r($_POST);
    // $infoQuizz = new Quizz($_POST["idQuizz"]);
    // $Quizz = $infoQuizz -> getTitreQuizz();
    
    $allResult = new Selectionner();
    $reps = $allResult -> recupeReponse($_POST["idQuizz"], $_POST["idUser"]);

    ?>
    <pre>
    <?php


    ?>
    </pre>
    <?php
    foreach($reps as $x)
    {
        $idDesQuestion = $x['idQuestion']." ";
        // echo $x['idReponse']."<br>";
    }
    print_r($idDesQuestion);
    $requete = getBdd() -> prepare("SELECT idQuestion, Titre FROM questions WHERE idQuizz = ? AND idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ? OR idQuestion = ?");
    $requete -> execute($idDesQuestion);
    $r = $requete -> fetchAll(PDO::FETCH_ASSOC);
    echo $r;
    ?>
    
    <h2 style="text-align: center;"><?=$Quizz;?></h2>
    <?php

    

}

