<?php
$profil = $result["data"];
?>
<h3>Page pour afficher son profil</h3>
<h3>Profil</h3>


<h2>Profil de <?= $profil->getPseudo() ?></h2>
<div>
    <?php
    if(!empty($profil->getAvatar()))
    {
        // var_dump($profil->getAvatar());die;
        ?>
        <img src="./public/img/avatars/<?php echo $profil->getAvatar()?>" width="150"/>
        <?php
    }
    ?>
    <p>
    Pseudo : <?= $profil->getPseudo() ?>
    </p>
    Mail : <?= $profil->getEmail() ?>
    <p>
</div>
<?php
// if(isset($_SESSION['id_userblog']) AND ($_GET['id'] == ""))
// if(isset($_SESSION['id_userblog']))
if(empty($_GET['id']))
    {
    ?>
    <a href="index.php?ctrl=secure&action=modifyprofil">Modifiez mon profil</a>
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



