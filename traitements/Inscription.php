<?php
require_once "../modeles/Modele.php";
$user = new User();
print_r($_POST);

if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["pseudo"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["mdp2"]) && !empty($_POST["questionSecrete"]) && !empty($_POST["repQuestion"]))
    {
        if(strlen($_POST["identifiant"]) < 50)
        {
            if(strlen($_POST["pseudo"]) < 50)
            {
                if(strlen($_POST["nom"]) < 50)
                {
                    if(strlen($_POST["prenom"]) < 50)
                    {
                        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                        {
                            if(strlen($_POST["mdp"]) > 6 && strlen($_POST["mdp"]) < 35)
                            {
                                if(strlen($_POST["repQuestion"]) < 100)
                                {
                                    if($_POST["mdp"] === $_POST["mdp2"])
                                    {
                                        if($user -> inscription($_POST["identifiant"], $_POST["pseudo"], $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"], $_POST["mdp2"], $_POST["questionSecrete"], $_POST["repQuestion"]) == true)
                                        {
                                            header("location:../pages/index.php?succes=inscription");
                                        }
                                        else
                                        {
                                            header("location:../pages/formulaireInscription.php?error=inscription");
                                        }
                                    }
                                    else
                                    {
                                        header("location:../pages/formulaireInscription.php?error=mdpPasEgaux");
                                    }
                                }
                                else
                                {
                                    header("location:../pages/formulaireInscription.php?error=repQuestionLong");
                                }
                            }
                            else
                            {
                                header("location:../pages/formulaireInscription.php?error=mdpCourt");
                            }
                        }
                        else
                        {
                            header("location:../pages/formulaireInscription.php?error=emailPasValid");
                        }
                    }
                    else
                    {
                        header("location:../pages/formulaireInscription.php?error=prenomLong");
                    }
                }
                else
                {   
                    header("location:../pages/formulaireInscription.php?error=nomLong");
                }
            }
            else
            {
                header("location:../pages/formulaireInscription.php?error=pseudoLong");
            }
        }
        else
        {
            header("location:../pages/formulaireInscription.php?error=idLong");
        }
    }
    else
    {
        header("location:../pages/formulaireInscription.php?error=ChampsVide");
    }
}
else
{
    header("location:../pages/formulaireInscription.php?error=ErreurForm");
}
?>
<h1>yo</h1>