<?php

class User extends Modele
{
    private $identifiant;
    private $idUser;
    private $pseudo;
    private $nom;
    private $prenom;
    private $mdp;
    private $mdp2;
    private $statut;
    private $idQuestionSecrete;
    private $repQuestionSecrete;

    public function __construct($idUser = null)
    {
        if(!empty($idUser))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM users WHERE idUser = ?");
            $requete -> execute([$idUser]);
            $infos = $requete -> fetch(PDO::FETCH_ASSOC);
            $this -> idUser = $infos["idUser"];
            $this -> identifiant = $infos["identifiant"];
            $this -> pseudo = $infos["pseudo"];
            $this -> email = $infos["email"];
            $this -> nom = $infos["nom"];
            $this -> prenom = $infos["prenom"];
            $this -> mdp = $infos["MDP"];
            $this -> mdp2 = $infos["MDP2"];
            $this -> statut = $infos["statut"];
            $this -> idQuestionSecrete = $infos["idQuestionSecrete"];
            $this -> repQuestionSecrete = $infos["repQuestionSecrete"];
        }
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function connexion($id, $mdp)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM users WHERE identifiant = ?");
        $requete -> execute([$id]);

        if($requete -> rowCount() > 0)
        {
            $erreurs = 0;
            $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
            if(!password_verify($mdp, $utilisateur["MDP2"]))
            {
                header("location:../pages/Connexion.php?error=FalseMdp");
                $erreurs += 1;
            }

            if($erreurs == 0)
            {
            $_SESSION["idUser"] = $utilisateur["idUser"];
            $_SESSION["identifiant"] = $utilisateur["identifiant"];
            $_SESSION["prenom"] = $utilisateur["prenom"];
            $_SESSION["nom"] = $utilisateur["nom"];;
            $_SESSION["email"] = $utilisateur["email"];
            $_SESSION["pseudo"] = $utilisateur["pseudo"];
            return true;
            }
        }
    }

    public function inscription($identifiant, $pseudo, $nom, $prenom, $email, $mdp, $mdp2, $idQuestionSecrete, $reponseSecrete)
    {
        try
        {
            $mdp2 = password_hash($mdp, PASSWORD_BCRYPT);
            $requete = $this -> getBdd() -> prepare("INSERT INTO users (identifiant, pseudo, nom, prenom, email, MDP, MDP2, idQuestionSecrete, repQuestionSecrete) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $requete -> execute([$identifiant, $pseudo, $nom, $prenom, $email, $mdp, $mdp2, $idQuestionSecrete, $reponseSecrete]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function getIdUser()
    {
        return $this->idUser;
    }
    
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getIdentifiant()
    {
        return $this->identifiant;
    }
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
///////////////////////////////////////////////////////////////////////////////////////

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getMdp()
    {
        return $this->mdp;
    }    
    public function setMdp($Mdp)
    {
        $this->mdp = $Mdp;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function getReponseSecrete()
    {
        return $this-> repQuestionSecrete;
    }    
    public function setReponse($reponse)
    {
        $this -> repQuestionSecrete = $reponse;
    }

    public function setIdQuestionSecrete($IdquestionSecrete)
    {
        $this -> idQuestionSecrete = $IdquestionSecrete;
    }

    public function getQuestionSecrete(){
        $requete = $this->getBdd()->prepare("SELECT intitule from questionSecrete where idQuestionSecrete = ?");
        $requete->execute([$this->idQuestionSecrete]);
        $QuestionSecrete = $requete->fetch(PDO::FETCH_ASSOC);
        return $QuestionSecrete;
    }

///////////////////////////////////////////////////////////////////////////////////////
    public function setStatut($statut)
    {
       $this->statut = $statut;
    }
    public function getStatut()
    {
       return $this->statut;
    }



}