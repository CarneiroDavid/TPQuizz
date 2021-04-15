<?php

class User extends Modele
{
    private $identifiant;
    private $pseudo;
    private $nom;
    private $prenom;
    private $mdp;
    private $mdp2;
    private $statut;
    private $idQuestionSecrete;
    private $repQuestionSecrete;
    private $listeQuestionSecrete;

    

    public function setUser($newId, $newNom, $newPrenom, $newStatut, $newMDP, $newMDP2, $newidQuestionSecrete, $newRepQuestionSecrete, $newPseudo)
    {
        $this -> identifiant = $newId;
        $this -> nom = $newNom;
        $this -> prenom = $newPrenom;
        $this -> statut = $newStatut;
        $this -> pseudo = $newPseudo;
        $this -> mdp = $newMDP;
        $this -> mdp2 = $newMDP2;
        $this -> idQuestionSecrete = $newidQuestionSecrete;
        $this -> repQuestionSecrete = $newRepQuestionSecrete;
    }

    public function getUser()
    {
        $test = [$this -> identifiant, $this -> pseudo, $this -> nom];
        return $test;
    }

    public function getQuestionsSecretes()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM questionsecrete");
        $requete -> execute();
        $this -> listeQuestionSecrete = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $this -> listeQuestionSecrete;
    }
}