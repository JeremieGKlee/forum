<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>FORUM</title>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
</head><?php
    // $marques = $result["data"];
?>

<h3>Page pour se connecter ou créer un nouveau compte</h3>
<h3>Connexion</h3>

<?php
$db = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

if(isset($_POST['formconnexion']))
{
    $pseudoconnect =htmlspecialchars($_POST['pseudoconnect']);
    if(!empty($_POST['pseudoconnect']) AND !empty($_POST['mdpconnect']))
    {
        $reqpseudo = $db->prepare("SELECT mdp FROM userblog WHERE pseudo = ? " );
        $reqpseudo->execute(array($pseudoconnect));
        // $pseudorexist = $reqpseudo->rowCount();
        // if($pseudoexist == 1)
        $resultat = $reqpseudo->fetchColumn();

        if(password_verify($_POST['mdpconnect'],$resultat))

        {
            $requser = $db->prepare("SELECT * FROM userblog WHERE pseudo = ? " );
            $requser->execute(array($pseudoconnect));
            $userinfo = $requser->fetch();
            $_SESSION['id_user'] = $userinfo['id_user'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['email'] = $userinfo['email'];
            header("location:profilView.php?id=".$_SESSION['id_user']);




        }
        else
        {
            $erreur = "Pseudo ou mot de passe non reconnu";
        }
    }
    else
    {
        $erreur = "Tous les champs ne sont pas remplis";
    }
}
?>

<div>
<form action="" method="post">
    <p>
        <label for="pseudoconnect">Votre Pseudo :</label>
        <input id="pseudoconnect" type="text" name="pseudoconnect" placeholder="Votre pseudo"/>
    </p>
        <label for="mdpconnect">Votre mot de passe :</label>        
        <input id="mdpconnect" type="password" name="mdpconnect" placeholder="Votre mot de passe" />
    </p>
    
    <p>
        <input type="submit" name="formconnexion" value="Se connecter" />
    <p>
</form>
<?php
if(isset($erreur))
{
    echo $erreur;
}
?>
</div>



