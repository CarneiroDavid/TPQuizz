<?php
class Reponse extends Modele
{
    private $idReponse; //Int
    private $idQuestion; // String
    private $reponse; // Array
    private $verification; //Bool

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
    public function initialiserReponse($idReponse, $idQuestion, $reponse, $verif)
    {
        $this -> idReponse = $idReponse;
        $this -> idQuestion = $idQuestion;
        $this -> reponse = $reponse;
        $this -> verification = $verif;
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function getReponse()
    {
        return $this -> reponse;
    }

    public function setReponse($Reponse)
    {
        $this -> reponse = $Reponse;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getIdReponse()
    {
        return $this -> idReponse;
    }
    public function setIdReponse($idReponse)
    {
        $this -> idReponse = $idReponse;
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function getIdQuestion()
    {
        return $this -> idQuestion;
    }
    public function setIdQuestion($idQuestion)
    {
        $this -> idQuestion = $idQuestion;
    }

///////////////////////////////////////////////////////////////////////////////////////   
    public function getVerification()
    {
        return $this -> verification;
    }
    public function setVerification($verification)
    {
        $this -> verification = $verification;
    }
///////////////////////////////////////////////////////////////////////////////////////

    public function creerReponse($idQuestion, $titre,$verif="vrai")
    {
        $requete = $this->getBdd()->prepare("INSERT INTO reponses(idQuestion,reponse,verification) VALUES (?,?,?)");
        $requete->execute([$idQuestion,$titre,$verif]);

        $requete = $this->getBdd()->prepare("SELECT idReponse from reponses where reponse = ?");
        $requete->execute([$titre]);
        $this->idReponse = $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function modifierReponse($reponse, $idReponse)
    {
        $requete = $this -> getBdd() -> prepare ("UPDATE reponses SET reponse = ? WHERE idReponse = ?");
        $requete -> execute([$reponse, $idReponse]);
    }

    public function supprimerReponse($idQuizz)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM reponses WHERE idQuizz = ?");
            $requete -> execute([$idQuizz]);
            return true;

        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
}