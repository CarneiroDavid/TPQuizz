<?php
class Lier extends Modele
{
    private $idUser;
    private $idAmis;

    public function insertion($idSession, $pseudo, $idUser)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO lier (idUser, pseudoEnvoyeur, idAmis) VALUES (?, ?, ?)");
            $requete -> execute([$idSession, $pseudo, $idUser]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function accepterAmis($idEnvoyeur, $idReceveur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("UPDATE lier SET Etat = 'Accepter' WHERE idUser = ? AND idAmis = ?");
            $requete -> execute([$idEnvoyeur, $idReceveur]);

            $requete = $this -> getBdd() -> prepare("SELECT pseudo FROM users WHERE idUser = ?");
            $requete -> execute([$idEnvoyeur]);
            $Envoyeur = $requete -> fetch(PDO::FETCH_ASSOC);
            
            $requete = $this -> getBdd() -> prepare("INSERT INTO lier (idUser, pseudoEnvoyeur, idAmis, Etat) VALUES (?, ?, ?, 'Accepter')");
            $requete -> execute([$idReceveur, $Envoyeur["pseudo"], $idEnvoyeur]);

            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function refuserAmis($idEnvoyeur, $idReceveur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM lier WHERE idUser = ? AND idAmis = ?");
            $requete -> execute([$idEnvoyeur, $idReceveur]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function bloquerAmis($idEnvoyeur, $idReceveur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("UPDATE lier SET Etat = 'Bloquer' WHERE idUser = ? AND idAmis = ?");
            $requete -> execute([$idEnvoyeur, $idReceveur]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function supprimerAmis($idEnvoyeur, $idReceveur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM lier WHERE idUser = ? AND idAmis = ?");
            $requete -> execute([$idEnvoyeur, $idReceveur]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function getIdUser($idUser)
    {
        $this -> idUser = $idUser;
    }

    public function getIdAmis($idAmis)
    {
        $this -> idAmis = $idAmis;
    }

    public function setIdUser()
    {
        return $this -> idUser;
    }

    public function setIdAmis()
    {
        return $this -> idAmis;
    }
}