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
    
    public function setIdQuizz($idQuizz)
    {
        $this -> idQuizz = $idQuizz; 
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function getTitreQuizz()
    {
        return $this -> titre;
    }
    public function setTitre($Titre)
    {
        $this -> titre = $Titre;
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function getCat()
    {
        return $this -> categorie;
    }
    public function setCat($idCat)
    {
         $this -> categorie = $idCat;
    }
///////////////////////////////////////////////////////////////////////////////////////


    public function getQuestions()
    {
        return $this -> questions;
    }

    public function addQuestion($question)
    {
        $this->question[$question->getIdQuestion()]= $question;
     
    }

    public function removeQuestion($idQuestion)
    {
        unset($this->question[$idQuestion]);
    }

///////////////////////////////////////////////////////////////////////////////////////   
    public function creerQuizz($idUser){
        $requete = $this->getBdd()->prepare("INSERT INTO quizz(idCategorie,Titre,idUser) VALUES (?,?,?)");
        $requete->execute([$this->categorie,$this->titre,$idUser]);

        $requete = $this->getBdd()->prepare("SELECT idQuizz from quizz where titre = ?");
        $requete->execute([$this->titre]);
        $this->idQuizz = $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function modifierQuizz()
    {
        $requete = $this -> getBdd() -> prepare("UPDATE quizz SET Titre = ?, idCategorie = ? WHERE idQuizz = ?");
        $requete -> execute([$this -> titre, $this -> categorie, $this -> idQuizz]);
    }

    public function supprimerQuizz($idQuizz)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM quizz WHERE idQuizz = ?");
            $requete -> execute([$idQuizz]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
    public function accepterQuizz($idQuizz)
    {
        try
        {   
            $requete = $this -> getBdd() -> prepare("UPDATE quizz SET statut = 'true' WHERE idQuizz= ?");
            $requete -> execute([$idQuizz]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
}