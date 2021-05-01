<?php

class Quizz extends Modele
{
    private $idQuizz; // int
    private $titre; // string
    private $categorie; // objet
    private $questions = []; // array

    public function __construct($idQuizz = null)
    {
        if($idQuizz !== null)
        {

            $requete = $this->getBdd()->prepare("SELECT titre, idCategorie FROM quizz WHERE idQuizz = ?");
            $requete->execute([$idQuizz]);
            $infos = $requete->fetch(PDO::FETCH_ASSOC);

            $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuizz = ?");
            $requete->execute([$idQuizz]);
            $questions = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idQuizz = $idQuizz;
            $this->titre  = $infos["titre"];
            $this->categorie = new Categorie($infos["idCategorie"]);          
            $i = 1;
            foreach ( $questions as $question )
            {
                $objetQuestion = new Question();
                $objetQuestion -> initialiserQuestion($question["idQuestion"], $question["Titre"]);
                $this -> questions[$i] = $objetQuestion;
                $i++;
            }
        }
    }

    public function getIdQuizz()
    {
        return $this -> idQuizz;
    }

    public function getTitleQuizz()
    {
        return $this -> titre;
    }

    public function getCat()
    {
        return $this -> categorie;
    }

    public function getQuestions()
    {
        return $this -> questions;
    }

    public function setIdQuizz()
    {

    }
    public function setTitre()
    {

    }

    public function addQuestion()
    {

    }

    public function removeQuestion()
    {
        
    }
}