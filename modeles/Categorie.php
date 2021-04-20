<?php
require_once "Modele.php";
class Categorie extends Modele
{
    private $idCategorie;
    private $nom;
    private $quizz = [];

    public function __construct($idCat = null)
    {
        if($idCat!=null)
        {
            $requete = $this->getBdd()->prepare("SELECT idCategorie, nom FROM categoriequizz WHERE idCategorie = ?");
            $requete->execute([$idCat]);
            $categories = $requete->fetch(PDO::FETCH_ASSOC);
            
            $this->idCategorie = $idCat;
            $this->nom = $categories["nom"];
        }
    }

    public function recupQuizz($idCat)
    {
        $requete = $this -> getBdd() ->prepare("SELECT * FROM quizz WHERE idCategorie = ?");
        $requete -> execute([$idCat]);
        $quizzs = $requete -> fetchAll(PDO::FETCH_ASSOC);

        foreach($quizzs as $Quizz)
        {
            $objetQuizz = new Quizz($Quizz["idQuizz"]);
            $this -> quizz[] = $objetQuizz;
        }
    }

    public function getListQuizz()
    {
        return $this -> quizz;
    }

    public function getIdCat()
    {
        return $this -> idCategorie;
    }  

    public function getNom()
    {
        return $this -> nom;
    }
}