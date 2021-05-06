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
        $requete = $this-> getBdd()-> prepare("SELECT * FROM selectionner WHERE idUser = ? AND idQuizz = ?");
        $requete->execute([$this->idUser,$this->idQuizz]);
        if($requete->rowCount() != 10){
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO selectionner(idUser, idReponse, idQuestion, idQuizz) VALUES (?, ?, ?, ?)");
            $requete -> execute([$this -> idUser, $this -> idReponse, $this -> idQuestion, $this -> idQuizz]);
        }
        catch(Exception $e)
        {
            return $e -> getMessage();
        }
        }
    }

    public function recupeReponse($idQuizz, $idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM selectionner WHERE selectionner.idQuizz = ? AND selectionner.idUser = ? ORDER BY idUser");
        $requete -> execute([$idQuizz, $idUser]);
        $resultats = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    }
}