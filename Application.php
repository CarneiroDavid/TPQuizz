<?php
require_once "modeles/Modele.php";


class Application extends Modele
{
    public function getAllCat()
    {   

        $requete = $this -> getBdd() -> prepare("SELECT * FROM categoriequizz");
        $requete -> execute();
        $allCat = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $allCat;
    }

    public function getAllQuizz()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM quizz");
        $requete -> execute();
        $allCat = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $allQuizz;
    }
}