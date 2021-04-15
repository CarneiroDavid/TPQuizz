<?php

class Modele
{
    protected function getBdd()
    {
        return new PDO('mysql:host=localhost;dbname=quizz;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}
require_once "Users.php";
require_once "Categorie.php";
require_once "Question.php";
require_once "Quizz.php";
require_once "Reponse.php";