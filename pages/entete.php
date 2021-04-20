<?php
require_once "../modeles/Modele.php";
// $bdd = new Modele();
// $quizz = new Quizz(2);

// $David = new User();

$application = new Application();
$cats = $application -> getAllCat();?>
<pre>
<?php
// print_r($cats);
// print_r($quizz);
// print_r(new Categorie());
// print_r($_SESSION);
?></pre><?php

// echo $_SESSION["prenom"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li>
                    <a class="nav-link" href="creerQuizz.php">Creer ton Quizz</a>
                </li>
                <?php
                if(empty($_SESSION))
                {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="Connexion.php">Connexion</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="formulaireInscription.php">Inscription</a>
                </li>
                <?php
                }
                else
                {
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                </li>
                    <?php
                }
                ?>

                
            </ul>
        </div>
    </div>
</nav>

<br>

<div class="container">