<?php
require_once "../modeles/Modele.php";
$user = new User();
print_r($_POST);
if(!empty($_POST["modifierUser"]))
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["pseudo"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["email"]))
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
                            if($user -> modifierUser($_POST["identifiant"], $_POST["pseudo"], $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["modifierUser"]) == true)
                            {
                                header("location:../pages/admin.php?success=modifReussi");
                            }
                            else
                            {
                                header("location:../pages/admin.php?error=modifReussi");
                            }
                        }
                        else
                        {
                            header("location:../pages/admin.php?error=emailFaux");
                        }
                    }
                    else
                    {
                        header("location:../pages/admin.php?error=prenomLong");
                    }

                }
                else
                {
                    header("location:../pages/admin.php?error=nomLong");
                }

            }
            else
            {
                header("location:../pages/admin.php?error=pseuodLong");
            }

        }
        else
        {
            header("location:../pages/admin.php?error=idTropLong");
        }
    }
    else
    {
        header("location:../pages/admin.php?error=champVide");
    }
}
else
{
    // header("location:../pages/admin.php?error=formulaire");

}