<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT lier.idUser as idEnvoyeur, idAmis,lier.pseudoEnvoyeur, Etat FROM lier INNER JOIN users ON users.idUser = lier.idAmis WHERE Etat = 'En attente' AND lier.idAmis = ?");
$requete -> execute([$_SESSION["idUser"]]);
$attente = $requete -> fetchAll(PDO::FETCH_ASSOC);

$requete = getBdd() -> prepare("SELECT * FROM lier INNER JOIN users ON users.idUser = lier.idAmis WHERE Etat = 'Accepter' AND lier.idUser = ?");
$requete -> execute([$_SESSION["idUser"]]);
$amis = $requete -> fetchAll(PDO::FETCH_ASSOC);
?><pre><?php
// print_r($amis);
?></pre>

<div>
    <h3>Demande d'amis en attentes</h3>
    <?php
    foreach($attente as $attenteAmis)
    {
        // if($_SESSION["idUser"] != $attenteAmis["idEnvoyeur"])
        // {
        
        ?>
        <div>
            <li class="list-group-item" style="height: 8%;">
                <?=$attenteAmis["pseudoEnvoyeur"];?>
                <div style="margin-bottom:2%; display:inline-block; margin-left:50%">
                    <form method="post" action="../traitements/accepterAmis.php">
                        <button type="submit" class="btn btn-success"  name="accepter" value="<?=$attenteAmis["idEnvoyeur"];?>">Accepter</button>
                        <button type="submit" class="btn btn-danger" name="refuser" value="<?=$attenteAmis["idEnvoyeur"];?>">Refuser</button>
                        <button type="submit" class="btn btn-danger" name="bloquer" value="<?=$attenteAmis["idEnvoyeur"];?>">Bloquer</button>
                    </form>
                </div>
            </li>
        </div>
        <?php
        // }
    }
    ?>
</div>
<br>
<div>
    <h3>Liste amis</h3>
    <?php
    foreach($amis as $ami)
    {
        ?>
        <li class="list-group-item">
            <?=$ami["pseudo"];?>
            <form method="post" action="../traitements/supprimerAmis.php">
                <button type="submit" class="btn btn-warning" name="supprimer" value="<?=$ami["idUser"];?>" style="display:inline-block; margin-left: 80%;">Supprimer</button>
            </form>
            
        </li>
        <?php
         
    }
    ?>
</div>
<form method="get" action="listAmis.php">
        <div class="col-md-6">
            <input type="text" class="form-control" name="recherche">
        </div>

        <button type="submit" class="btn btn-primary">Rechercher</button>        
    </form>
<?php
if(!empty($_GET["recherche"]))
{
    $get = $_GET["recherche"];
    $requete = getBdd() -> prepare("SELECT idUser, pseudo FROM users WHERE pseudo LIKE ?");
    $requete -> execute(['%'.$get.'%']);
    $resultatRecherche = $requete -> fetchAll(PDO::FETCH_ASSOC);?>
    <pre>
        <?php
        // print_r($_GET);
        // print_r($resultatRecherche);
        ?>
    </pre>

    <div>
        <ul>
            <?php
            foreach($resultatRecherche as $user)
            {
                if($user["idUser"] == $_SESSION["idUser"])
                {
                ?>
                <div >
                    <li class="list-group-item"><?=$user["pseudo"];?>
                        <form method="post" action="../traitements/demandeAmis.php">
                            <input type="hidden" name="idReceveur" value="<?=$user["idUser"];?>">
                            <fieldset disabled>
                            <button style="margin-left:90%;" name="bouton" value="1">Ajouter</button>
                            </fieldset>
                        </form>
                    </li>
                </div>
                <?php
                }
                else
                {
                ?>
                <div >
                    <li class="list-group-item"><?=$user["pseudo"];?>
                        <form method="post" action="../traitements/demandeAmis.php">
                            <input type="hidden" name="idReceveur" value="<?=$user["idUser"];?>">
                            <input type="hidden" name="idEnvoyeur" value="<?=$_SESSION["idUser"];?>">
                            <input type="hidden" name="pseudoEnvoyeur" value="<?=$_SESSION["pseudo"];?>">
                            <button style="margin-left:90%;" name="bouton" value="1">Ajouter</button>
                            
                        </form>
                    </li>
                </div>
                <?php
                }
            }
            ?>
        </ul>
    </div>
    <?php
}