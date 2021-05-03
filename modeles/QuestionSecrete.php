<?php

class QuestionSecrete extends Modele
{
    private $idQuestionSecrete;
    private $intitule;

    public function __construct($idUser = null)
    {
        if(!empty($idUser))
        {
            $requete = $this->getBdd()->prepare("SELECT intitule,idQuestionSecrete from users RIGHT JOIN questionsecrete USING(idQuestionSecrete)where idUser = ?");
            $requete->execute([$idUser]);
            $QuestionSecrete = $requete->fetchALL(PDO::FETCH_ASSOC);
            $this -> intitule = $QuestionSecrete["intitule"];
            $this -> idQuestionSecrete = $QuestionSecrete["idQuestionSecrete"];
        }
    }

    public function getQuestionsSecretes()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM questionsecrete");
        $requete -> execute();
        $this -> listeQuestionSecrete = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $this -> listeQuestionSecrete;
    }

    public function getQuestionSecretes($identifiant)
    {
        $requete = $this->getBdd()->prepare("SELECT intitule from users LEFT JOIN questionsecrete USING (idQuestionSecrete) WHERE identifiant = ? ");
        $requete->execute([$identifiant]);
        $intitule = $requete->fetch(PDO::FETCH_ASSOC);
        
        $this-> intitule = $intitule["intitule"];
        
    }
    public function getIntitule(){
        return $this->intitule;
    }
    public function setIntitule($intitule){
        $this->intitule=$intitule;
    }
    public function getIdQuestionSecrete(){
        return $this->idQuestionSecrete;
    }
    public function setIdQuestionSecrete($idQuestionSecrete){
        $this->idQuestionSecrete= $idQuestionSecrete;
    }
}