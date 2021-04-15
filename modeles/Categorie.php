<?php
require_once "Modele.php";
class Categorie extends Modele
{
    private $idCategorie;
    private $nom;

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

    public function getIdCat()
    {
        return $this -> idCategorie;
    }  

    public function getNom()
    {
        return $this -> nom;
    }

}