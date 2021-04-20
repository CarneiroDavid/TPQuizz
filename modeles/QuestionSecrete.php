<?php

class QuestionSecrete extends Modele
{
    private $idQuestionSecrete;
    private $intitule;

    public function getQuestionsSecretes()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM questionsecrete");
        $requete -> execute();
        $this -> listeQuestionSecrete = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $this -> listeQuestionSecrete;
    }
}