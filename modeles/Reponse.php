<?php
require_once "Modele.php";

class Reponse extends Modele
{
    private $idReponse;
    private $idQuestion;
    private $reponse;
    private $verification;

    public function __construct($idRep = null)
    {
        if($idRep != null)
        {
            $requete = $this->getBdd()->prepare("SELECT idReponse, idQuestion, reponse, verification FROM reponses WHERE idReponse = ?");
            $requete->execute([$idRep]);
            $reps = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idReponse =$idRep;
            $this -> idQuestion = $reps["idQuestion"];
            $this -> reponse = $reps["reponse"];
            $this -> verification = $reps["verification"];
        }
        

    }
    public function initialiserReponse($idQuestion, $reponse, $verif)
    {
        $this -> idQuestion = $idQuestion;
        $this -> reponse = $reponse;
        $this -> verification = $verif;
    }
    public function getReponse()
    {
        return $this -> reponse;
    }
    public function getIdReponse()
    {
        return $this -> idReponse;
    }
    public function getIdQuestion()
    {
        return $this -> idQuestion;
    }
    public function getVerification()
    {
        return $this -> verification;
    }
}