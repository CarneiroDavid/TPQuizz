<?php
class Question extends Modele
{
    private $idQuizz;
    private $idQuestion;
    private $titre;
    private $reps = [];
    // private question = [];

    public function __construct($idQuestion = null)
    {
        if($idQuestion!=null)
        {
            $requete = $this->getBdd()->prepare("SELECT idQuizz, idQuestion, Titre FROM questions WHERE idQuestion = ?");
            $requete->execute([$idQuestion]);
            $r = $requete->fetch(PDO::FETCH_ASSOC);

            $requete = $this -> getBdd()->prepare("SELECT * FROM reponses WHERE idQuestion = ?");
            $requete ->execute([$idQuestion]);
            $x = $requete -> fetchAll(PDO::FETCH_ASSOC);

            $this->idQuestion = $idQuestion;
            $this->idQuizz = $r["idQuizz"];
            $this->titre = $r["Titre"];

            $i = 1;
            foreach($x as $y)
            {
                $Reponse = new Reponse($y["idReponse"]);

                $this->reps[$i] = $Reponse;
                $i++;
            }
            // print_r($this->reps);
        }
    }

    public function initialiserQuestion($idQuestion, $Titre)
    {
        $this -> idQuestion = $idQuestion;
        $this -> titre = $Titre;

        $requete = $this -> getBdd()->prepare("SELECT * FROM reponses WHERE idQuestion = ?");
        $requete ->execute([$idQuestion]);
        $x = $requete -> fetchAll(PDO::FETCH_ASSOC);

        $i = 1;
        foreach($x as $y)
        {
            $objetReponse = new Reponse();
            $objetReponse -> initialiserReponse($y["idReponse"], $y["idQuestion"], $y["reponse"], $y["verification"]);
            $this -> reps[$i] = $objetReponse;  
            $i++;     
        }
    }
    // public function 

///////////////////////////////////////////////////////////////////////////////////////
    public function getIdQuizz()
    {
        return $this -> idQuizz;
    }
    public function setIdQuizz($idQuizz)
    {
        $this -> idQuizz = $idQuizz;
    }

///////////////////////////////////////////////////////////////////////////////////////   

    public function getIdQuestion()
    {
        return $this -> idQuestion;
    }
    public function setIdQuestion($idQuestion)
    {
        $this -> idQuestion =  $idQuestion;
    }

///////////////////////////////////////////////////////////////////////////////////////

    public function getTitre()
    {
        return $this -> titre;
    }
    public function setTitre($titre)
    {
        $this -> titre = $titre;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getReps()
    {
        return $this -> reps;
    }


    public function addReponse($Reponse)
    {
        $this-> reps[$Reponse->getIdReponse()] = $Reponse;
    } 

    public function removeReponse($idReponse)
    {
        unset($this->reps[$idReponse]);
    }
///////////////////////////////////////////////////////////////////////////////////////

    public function creerQuestion($idQuizz, $titre)
    {
        $requete = $this->getBdd()->prepare("INSERT INTO questions(idQuizz,Titre) VALUES (?,?)");
        $requete->execute([$idQuizz,$titre]);

        $requete = $this->getBdd()->prepare("SELECT idQuestion from questions where titre = ? AND idQuizz = ?");
        $requete->execute([$titre, $idQuizz]);
        $idQuestion = $requete->fetch(PDO::FETCH_ASSOC);
        $this->idQuestion = $idQuestion["idQuestion"];

    }
}