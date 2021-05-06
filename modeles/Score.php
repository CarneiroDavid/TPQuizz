<?php

Class Score extends Modele
{
    private $idUser;
    private $score=[];

    public function __construct($idUser = null)
    {
        if(!empty($idUser))
        {
            $requete=$this->getBdd()->prepare("SELECT * FROM scores WHERE idUser = ?");
            $requete->execute([$idUser]);
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultat as $quizz){
                $this->score[$quizz["idQuizz"]] = $quizz["Score"];
            }
        }
    }

    public function setIdUser($idUser){
        $this->idUser= $idUser;
    }
    public function getIdUser(){
        return $this->idUser;
    }
    public function getScore(){
        return $this->score;
    }
    public function addScore($idQuizz,$score)
    {
        $this->score[$idQuizz]=$score;
    }
    public function deleteScore($idQuizz,$score)
    {
        $this->score[$idQuizz]=$score;
    }
    public function creerScore($idUser,$idQuizz,$score){
        try{
        $requete=$this->getBdd()->prepare("INSERT INTO scores (idUser,idQuizz,Score) VALUES (?,?,?) ");

        $requete->execute([$idUser,$idQuizz,$score]);
        return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function recupScore($idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT scores.idUser, quizz.Titre,scores.idQuizz, Score FROM scores INNER JOIN quizz ON scores.idQuizz = quizz.idQuizz WHERE scores.idUser = ?");
        $requete -> execute([$idUser]);
        $scores = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $scores;
    }
}