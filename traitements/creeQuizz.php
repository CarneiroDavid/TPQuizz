<?php
require_once "../modeles/Modele.php";
?>

<?php
    $requete = getBdd()->prepare("SELECT * FROM categoriequizz WHERE idCategorie = ?");
    $requete->execute([$_POST["Quizz"]["idCategorie"]]);
    if($requete -> rowCount() != 0)
    {
        if(!empty($_POST["Quizz"]["titre"]) && strlen($_POST["Quizz"]["titre"]) >= 3 && strlen($_POST["Quizz"]["titre"]) <= 60)
        {
            foreach($_POST["Quizz"]["question"] as $x => $question)
            {
                if(empty($question["titre"]))
                {
                    $erreur[$x] = "Question ". $x." : L'intitulé de la question est vide";
                }
                
                if(strlen($question["titre"]) <=1)
                {
                    $erreur[$x] = "Question ". $x." : L'intitulé de la question est trop cours, 5 caractères minimum";
                }
                if(strlen($question["titre"]) >=60)
                {
                    $erreur[$x] = "Question ". $x." : L'intitulé de la question est trop long, 60 caractères maximum";
                }
                foreach($question["reponse"] as $NumeroReponse => $reponse){
                    if(empty($reponse)){
                        $erreur[$x]= "Question ". $x." : La Reponse ". $NumeroReponse ." est vide"; 
                    }
                    if(strlen($reponse) >=60){
                        $erreur[$x]= "Question ". $x." : La Reponse ". $NumeroReponse ." est trop long, 60 caractères maximum"; 
                    }
                }
            }
            if(empty($erreur))
            {
                $newQuizz = new Quizz();
                $newQuizz->setTitre($_POST["Quizz"]["titre"]);
                $newQuizz->setCat($_POST["Quizz"]["idCategorie"]);
                $newQuizz -> setIdQuizz($_POST["Quizz"]["idQuizz"]);
                
                if($_POST["Quizz"]["action"] == "modifier")
                {
                    $newQuizz -> modifierQuizz();

                }
                elseif($_POST["Quizz"]["action"] == "creer")
                {
                    $newQuizz->CreerQuizz($_SESSION["idUser"]);
                }
                
                $idQuizz = $newQuizz-> getIdQuizz();
                $i=1;
                foreach($_POST["Quizz"]["question"] as $idQuestion => $question)
                {
                    $newQuestion = new Question();
                    
                    if($_POST["Quizz"]["action"] == "modifier")
                    {
                        $newQuestion -> modifierQuestion($question["titre"], $idQuestion, $_POST["Quizz"]["idQuizz"]);
                    }
                    elseif($_POST["Quizz"]["action"] == "creer")
                    {
                        $newQuestion-> creerQuestion($idQuizz["idQuizz"], $question["titre"]);
                    }
                    $idQuestion= $newQuestion -> getIdQuestion();
           
                    foreach($question["reponse"] as $idReponse => $reponse)
                    {
                        $newReponse = new Reponse();

                        if($_POST["Quizz"]["action"] == "creer")
                        {
                            if($i==1){

                                $newReponse -> creerReponse($idQuestion, $reponse);
                                $verif = $newReponse->getIdReponse();
                                
                                print_r($verif);
                            }else{
                                $newReponse -> creerReponse($idQuestion, $reponse, $verif["idReponse"]);
                            }
                            $i++;
                        }

                        if($_POST["Quizz"]["action"] == "modifier")
                        {
                            $newReponse -> modifierReponse($reponse, $idReponse);
                            header("location:../pages/admin.php?success=reponseModifier");
                        }
                    }
                    $i=1;
                }
            }else{
                ?>
                <pre>
                <?php
                $rapport="";
                foreach($erreur as $q){
                    $rapport = $rapport." ".$q." <br>";
                }
                header("location:../pages/creerQuizz.php?erreur=$rapport");
                ?>
                </pre>
                <?php
            }
        }else{
             $erreur = "Le titre du Quizz doit contenir entre 3 et 60 caractères";
             header("location:../pages/creerQuizz.php?erreur=$erreur");
        }

    }else{

        $erreur = "la catégorie selectionné n'existe pas";
        header("location:../pages/creerQuizz.php?erreur=$erreur");
    }
    ?>