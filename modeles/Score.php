<?php

Class Score extends Modele
{
    private $idUser;
    private $score=[];

    public function __construct($idUser = null)
    {
        if(!empty($idUser))
        {
            $requete=$this->getBdd()->prepare("SELECT * FROM participer WHERE idUser = ?");
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
        $requete=$this->getBdd()->prepare("INSERT INTO participer (idUser,idQuizz,Score) VALUES (?,?,?) ");

        $requete->execute([$idUser,$idQuizz,$score]);
        return true;
        }catch(Exception $e){
            return false;
        }
    }
}