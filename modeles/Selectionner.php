<?php

class Selectionner extends Modele
{
    private $idUser;
    private $idReponse;
    private $idQuestion;
    private $idQuizz;

    public function initialiserSelectionner($idUser, $idReponse, $idQuestion, $idQuizz)
    {
        $this -> idUser = $idUser;
        $this -> idReponse = $idReponse;
        $this -> idQuestion = $idQuestion;
        $this -> idQuizz = $idQuizz;
    }

    public function insertion()
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO selectionner(idUser, idReponse, idQuestion, idQuizz) VALUES (?, ?, ?, ?)");
            $requete -> execute([$this -> idUser, $this -> idReponse, $this -> idQuestion, $this -> idQuizz]);
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
}