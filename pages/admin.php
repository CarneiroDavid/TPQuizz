<?php
require_once "entete.php";
$quizzs = new Application();
$listQuizz = $quizzs -> getAllQuizz();
?><pre><?php
// print_r($_POST);
?></pre><?php
if($_SESSION["statut"] == "Admin")
{
    if(empty($_POST["idQuizz"]) && empty($_GET["idUser"]))
    {
        ?>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" onclick="apparitionQuizz()">Quizz</button>
        </div>
        <?php
        print_r($listQuizz);
        ?><div id="allQuizz" style="display: none;">
            <?php
            foreach($listQuizz as $quizz)
            {
                ?>
                <div class="card text-center" style="width: 50%; float:left; height:30%; margin-bottom:5%">
                    <div class="card-header">
                        <h5 class="card-title" style="text-align: center; margin-top:2%">
                            <?=$quizz["Titre"];?>
                        </h5>
                    </div>            
                    <div class="card-body">
                    
                        <?php
                        if($quizz["statut"] == "attente")
                        {
                            ?>
                            <form method="post" action="admin.php">
                            <p><button name='idQuizz' value='<?=$quizz['idQuizz'];?>'>Verifier le quizz</button></p>
                            </form>
                            <form method="post" action="../traitements/accepterQuizz.php">
                                <button type="submit" name="accepterQuizz" value="<?=$quizz["idQuizz"];?>" class="btn btn-success">Accepter</button>
                            </form>
                            <p><a href="supprimerQuizz?idQuizz=<?=$quizz['idQuizz'];?>">Supprimer</a></p>
                            <?php
                        }
                        else
                        {
                            ?>
                            <form method="post" action="admin.php">
                            <p><button name='idQuizz' value='<?=$quizz['idQuizz'];?>'>Verifier le quizz</button></p>
                            </form>
                            <p><a href="supprimerQuizz?idQuizz=<?=$quizz['idQuizz'];?>">Supprimer</a></p>
                            <?php
                        }
                            ?>
                    </div>
                    <div class="card-footer text-muted">
                        <?=$quizz["statut"];?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="d-grid gap-2" style="margin-top: 5%;">
            <button class="btn btn-primary" onclick="apparitionUser()">Utilisateur</button>
        </div>

        <?php
        $user = new User();
        $allUser = $user -> allUser();
        // print_r($allUser);
        ?>
        <div id="allUser" style="display:block">
            <ul class="list-group">
                <a class="btn btn-outline-primary" href="formulaireInscription.php" class="list-group-item d-flex justify-content-between align-items-center">
                    Creer Un utilisateur
                </a>
                <?php
                    foreach($allUser as $user)
                    {
                        ?>
                        <a href="profil.php?idUser=<?=$user['idUser'];?>">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?=$user["pseudo"];?>
                                <span class="badge bg-primary rounded-pill"></span>
                                <span style="margin-top: 1%;">
                                    <form method="post" action="../traitements/supprimerUser.php">
                                    <a class="btn btn-warning" href="admin.php?idUser=<?=$user["idUser"];?>">Modifier</a>
                                    <a class="btn btn-danger" href="supprimerUser.php?idUser=<?=$user["idUser"];?>">Supprimer</a>
                                    </form>
                                </span>
                            </li>
                        </a>
                        
                <?php
                    }
                    ?>
                    
            </ul>
        </div>
        <?php
    }

    if(!empty($_POST["idQuizz"]))
    {
        $quizz = new Quizz($_POST["idQuizz"]);
        ?>
        <h3>Vérification du quizz</h3>
        <form method="post" action="../traitements/creeQuizz.php">
            <div class="col-md-6">
                <label for="Quizz[titre]">Titre du quizz</label>
                <input type="text" class="form-control" name="Quizz[titre]" value="<?=$quizz -> getTitreQuizz();?>">
                <input type="hidden" class="form-control" name="Quizz[action]" value="modifier">
                <input type="hidden" class="form-control" name="Quizz[idQuizz]" value="<?=$_POST['idQuizz'];?>">
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
            <?php
            $i = 1;
            
            foreach($quizz -> getQuestions() as $question)
            {   
                $x = 1;
                $reps = $question -> getReps();
                
                ?>
                <div style="border: 1px solid black;">
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

    if(!empty($_GET["idUser"]))
    {
        $user = new User($_GET["idUser"]);
        // $user2 = $user -> infoUser($_GET["idUser"]);
        // print_r($user2);
        ?>
        <h2>Modification de l'utilisateur <?=$user -> getPseudo();?> </h2>
        <form class="row g-3" method="post" action="../traitements/modifierUser.php">
            <div class="col-md-6">
                <label calss="form-label">Identifiant</label>
                <input type="text" class="form-control" name="identifiant" value="<?=$user -> getIdentifiant();?>">
            </div>
            <div class="col-md-6">
                <label calss="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" value="<?=$user -> getPseudo();?>">
            </div>
            <div class="col-md-6">
                <label calss="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" value="<?=$user -> getNom();?>">
            </div>
            <div class="col-md-6">
                <label calss="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" value="<?=$user -> getPrenom();?>">
            </div>
            <div class="col-md-12">
                <label calss="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?=$user -> getEmail();?>">
            </div>
            <div>
            <button type="submit" name="modifierUser" value="<?=$user -> getIdUser();?>" class="btn btn-primary">Valider les informations</button>
            </div>
        </form>
        <?php
        

    }
}else
{
    header("location:index.php");
}
require_once "pied.php";
?>
<script>
function apparitionQuizz()
{
    var divQuizz = document.getElementById("allQuizz");

    if(divQuizz.style.display  == "none")
    {
        divQuizz.style.display  = "block";
    }

    else if(divQuizz.style.display  == "block")
    {
        divQuizz.style.display  = "none";
    }
}
function apparitionUser()
{
    var divUser = document.getElementById("allUser");

    if(divUser.style.display  == "none")
    {
        divUser.style.display  = "block";
    }

    else if(divUser.style.display  == "block")
    {
        divUser.style.display  = "none";
    }
}
</script>
