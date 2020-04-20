<?php
$profil = $result["data"];
?>
<html>
    <head>
        <title>Modification Profil</title>
        <meta charset="utf-8">
    </head>
    <body>   
        <div>
            <h2>Modification de mon profil</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="newpseudo">Votre Pseudo :</label>
                <input id="newpseudo" type="text" name="newpseudo" placeholder="Votre nouveau Pseudo" value="<?= $profil->getPseudo() ?>"/><br><br>
                <!-- Ou utiliser $_SESSION pour remplir les champs -->
                <label for="newmail">Votre nouveau mail :</label>
                <input id="newmail" type="mail" name="newmail" placeholder="Votre nouveau mail" value="<?= $profil->getEmail() ?>"/><br><br>
                <label for="newmail2">Confirmation de votre nouveau mail :</label>
                <input id="newmail2" type="mail" name="newmail2" placeholder="Confirmation de votre nouveau mail" value="<?= $profil->getEmail() ?>"/><br><br>
                <label for="newmdp1">Votre nouveau mot de passe :</label>
                <input id="newmdp1" type="password" name="newmdp1" placeholder="Votre nouveau mot de passe"/><br><br>
                <label for="newmdp2">Confirmation de votre nouveau mot de passe :</label>
                <input id="newmdp2" type="password" name="newmdp2" placeholder="confirmation de votre nouveau Pseudo"/><br><br>
                <label for="">Avatar :</label>
                <input type="file" name="avatar"/><br><br>
                <input id="maj" type="submit" value="Mise à jour de mon profil">
            </form>
        </div>
        <a href="index.php?ctrl=secure&action=displayprofil">Retour sur mon profil</a>
    </body>
    <?php
    if(!empty($_GET['id']))
    {
        header('location:index.php?ctrl=secure&action=hacker');
    }
    ?>
</html>


