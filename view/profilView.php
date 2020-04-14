<?php
$profil = $result["data"];
?>
<h3>Page pour afficher son profil</h3>
<h3>Profil</h3>


<h2>Profil de <?= $profil->getPseudo() ?></h2>
<div>
    <p>
    Pseudo : <?= $profil->getPseudo() ?>
    </p>
    Mail : <?= $profil->getEmail() ?>
    <p>
</br>
<?php
if(isset($_SESSION['id_userblog']) AND ($_GET['id'] == ""))
// if(isset($_SESSION['id_userblog']))
    {
    ?>
    <a href="index.php?ctrl=secure&action=modifyprofil&id="<?= $_SESSION['id_userblog']; ?>>Modifiez mon profil</a>
    <?php
    }
    else
    {
        header('location:index.php?ctrl=secure&action=hacker');
    }
    ?>
</br>
</br>

<a href="index.php?ctrl=secure&action=logout">Se déconnecter</a>



