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
    private $QuestionSecrete;
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
            $this -> QuestionSecrete = new questionSecrete();
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
            $_SESSION["statut"] = $utilisateur["statut"];
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
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->pseudo = $nom;
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function setPrenom($prenom)
    {
        $this->pseudo = $prenom;
    }
    public function getPrenom()
    {
        return $this->prenom;
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
    public function ChangeMdp($Mdp,$idUser){
        
        try{
            $Mdp2 = password_hash($Mdp, PASSWORD_BCRYPT);
            $requete=$this->getBdd()->prepare("UPDATE users SET MDP = ?, MDP2= ? WHERE idUser= ?");
            $requete->execute([$Mdp,$Mdp2, $idUser]);
            return true;
        }
        catch(Exception $e)
        {
            return $e;
        }

        
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

    public function setIdQuestionSecrete($questionSecrete)
    {
        $this -> QuestionSecrete = $questionSecrete;
    }

    public function getQuestionSecrete(){
        
        return $this->QuestionSecrete;
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
//////////////////////////////////////////////////////////////////////////////////////////////
    public function allUser()
    {
        $requete = $this -> getBdd() -> prepare("SELECT idUser, pseudo, statut FROM users");
        $requete -> execute();
        $allUser = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $allUser;
    }

    public function modifierUser($identifant, $pseudo, $nom, $prenom, $email, $idUser)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("UPDATE users SET identifiant = ?, pseudo = ?, nom = ?, prenom = ?, email = ? WHERE idUser = ?");
            $requete -> execute([$identifant, $pseudo, $nom, $prenom, $email, $idUser]);
            return true;
        }catch(Exception $e)
        {
            echo $e -> getMessage();
        }    
    }

    public function supprimerUser($idUser)
    {
        $requete = $this -> getBdd() -> prepare("DELETE FROM users WHERE idUser = ?");
        $requete -> execute([$idUser]);
        $requete = $this -> getBdd() -> prepare("DELETE FROM selectionner WHERE idUser = ?");
        $requete -> execute([$idUser]);
        $requete = $this -> getBdd() -> prepare("DELETE FROM quizz WHERE idUser = ?");
        $requete -> execute([$idUser]);
        $requete = $this -> getBdd() -> prepare("DELETE FROM participer WHERE idUser = ?");
        $requete -> execute([$idUser]);
        $requete = $this -> getBdd() -> prepare("DELETE FROM lier WHERE idUser = ?");
        $requete -> execute([$idUser]);
    }

    public function infoUser($idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT *FROM users WHERE idUser = ?");
        $requete -> execute([$idUser]);
        $infos = $requete -> fetch(PDO::FETCH_ASSOC);
        return $infos;
    }



}