<?php
session_start();


$db = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
if(isset($_SESSION['id_user']))
{
    $requser = $db->prepare("SELECT * FROM userblog WHERE id_user = ?");
    $requser->execute(array($_SESSION['id_user']));
    $user=$requser->fetch();

    if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $db->prepare("UPDATE userblog SET pseudo = ? WHERE id_user = ? " );
        $insertpseudo->execute(array($newpseudo, $_SESSION['id_user']));
        header('location: profilView.php?id='.$_SESSION['id_user']);
    }

    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $db->prepare("UPDATE userblog SET email = ? WHERE id_user = ? " );
        $insertmail->execute(array($newmail, $_SESSION['id_user']));
        header('location: profilView.php?id='.$_SESSION['id_user']);
    }

    if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        
        $newmdp1 = password_hash($_POST['newmdp1'],PASSWORD_DEFAULT);
        $newmdp2 = password_hash($_POST['newmdp2'],PASSWORD_DEFAULT);

        if( $_POST['newmdp1'] == $_POST['newmdp2'])
        {
            $insertmdp = $db->prepare("UPDATE userblog SET mdp = ? WHERE id_user = ? " );
            $insertmdp->execute(array($newmdp1, $_SESSION['id_user']));
            header('location: profilView.php?id='.$_SESSION['id_user']);
        }
        else
        {
            $erreur = "Vos 2 mots de passe ne sont pas identiques";
        }
        
    }
?>
<html>
    <head>
        <title>Modification Profil</title>
        <meta charset="utf-8">
    </head>
    <body>   
        <div>
            <h2>Modification de mon profil</h2>
            <form method="post" action="">
                <label for="newpseudo">Votre Pseudo :</label>
                <input id="newpseudo" type="text" name="newpseudo" placeholder="Votre nouveau Pseudo" value="<?php echo $user['pseudo'];?>"/><br><br>
                <label for="newmail">Votre nouveau mail :</label>
                <input id="newmail" type="mail" name="newmail" placeholder="Votre nouveau mail" value="<?php echo $user['email'];?>"/><br><br>
                <label for="newmail2">Confirmation de votre nouveau mail :</label>
                <input id="newmail2" type="mail" name="newmail2" placeholder="Confirmation de votre nouveau mail" value="<?php echo $user['email'];?>"/><br><br>
                <label for="newmdp1">Votre nouveau mot de passe :</label>
                <input id="newmdp1" type="password" name="newmdp1" placeholder="Votre nouveau mot de passe"/><br><br>
                <label for="newmdp2">Confirmation de votre nouveau mot de passe :</label>
                <input id="newmdp2" type="password" name="newmdp2" placeholder="confirmation de votre nouveau Pseudo"/><br><br>
                <input id="maj" type="submit" value="Mise à jour de mon profil">
            </form>
            <?php
            if(isset($erreur))
            {
                echo $erreur;
            }
            ?>
        </div>
    </body>
</html>
<?php
}
else
{
    header("location : connectCreateView.php");
}
?>


