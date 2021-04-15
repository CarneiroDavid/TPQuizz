<?php
require_once "Modele.php";

class Question extends Modele
{
    private $idQuizz;
    private $idQuestion;
    private $titre;
    private $reps = [];
    // private question = [;]

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

            
            foreach($x as $y)
            {
                $Reponse = new Reponse($y["idReponse"]);

                $this->reps[] = $Reponse;
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

        foreach($x as $y)
        {
            $objetReponse = new Reponse();
            $objetReponse -> initialiserReponse($y["idQuestion"], $y["reponse"], $y["verification"]);
            $this -> reps[] = $objetReponse;       
        }

    }
    public function getIdQuizz()
    {
        return $this -> idQuizz;
    }
    
    public function getIdQuestion()
    {
        return $this -> idQuestion;
    }
    public function getTitre()
    {
        return $this -> titre;
    }
    public function getReps()
    {
        return $this -> reps;
    }
}