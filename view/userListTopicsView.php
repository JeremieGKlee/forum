
<?php
$topics = $result["data"]["topic"];
?>   

<h1>Bienvenue sur mon petit Forum Muselé</h1>
<h2>Bonjour <?= $_SESSION['pseudo'] ?></h2>
<h3>Derniers Topics du Forum :</h3>
<?php

    if(!empty($topics))
    {
        foreach($topics as $topic)
        {

?> 

    <div class="news">
        <h3>
            <?= filter_var($topic->getTitle(),FILTER_SANITIZE_STRING) ?>
            <?php if($_SESSION['id_userblog'] == $topic->getUserBlog()->getId())
            {
            ?>
            <a href="index.php?ctrl=home&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer le topic</a>
            <?php
            }
            ?>
            <?= $topic->getClosed() ? "(- Topic verrouillé)" : "" ;?>
            </br>
             Créé par <img src="./public/img/avatars/<?php echo $topic->getUserBlog()->getAvatar()?>" width="20"/><?= $topic->getUserBlog()->getPseudo() ?>
            <em>le <?= $topic->getTopicDate() ?></em>
        </h3>
        <p>
            <?= nl2br(filter_var($topic->getContent()),FILTER_SANITIZE_STRING) ?>
            <br />
            <em><a href="index.php?ctrl=home&amp;action=affichePostsTopic&amp;id=<?= $topic->getId() ?>">Posts</a></em>
        </p>
    </div>
<?php
        }
    }
?>
<form action="index.php?ctrl=home&action=ajouteTopic&id=" method="post">
<!-- <a href="index.php?ctrl=home&action=affichetopics&id="<?= $_SESSION['id_userblog']; ?>>Accueil</a> -->
    <div>
        <label for="title">Titre du billet</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Contenu</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
        
    </div>
</form>
<?php
// $posts->closeCursor();
?>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
</script>