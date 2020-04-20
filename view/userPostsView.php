<?php
$topic = $result["data"]["topic"];
$postblogs = $result["data"]["postblog"];
// var_dump ($result["data"]);die;

?>   
<h1>Posts du Topic!</h1>
<p><a href="index.php?ctrl=home&action=affichetopics&id="<?= $_SESSION['id_userblog']; ?>>Retour à la liste des Topics</a></p>


<div class="news">
    <h3>
        <?= filter_var($topic->getTitle(),FILTER_SANITIZE_STRING) ?>
        </br>
        Crée par <img src="./public/img/avatars/<?php echo $topic->getUserBlog()->getAvatar()?>" width="20"/><?= $topic->getUserBlog()->getPseudo()?>
        <em> le <?= $topic->getTopicDate() ?></em>
    </h3>
    
    <p>
        <?= nl2br(filter_var($topic->getContent()),FILTER_SANITIZE_STRING) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="index.php?ctrl=home&action=ajoutePost&id=<?= $_GET['id'] ?>" method="post">

    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
// while ($comment = $comments->fetch())
if(!empty($postblogs))
{
    foreach($postblogs as $postblog)
{
?>
<p><?= nl2br(filter_var($postblog->getPost()),FILTER_SANITIZE_STRING) ?></p>
Créé par <img src="./public/img/avatars/<?php echo $postblog->getUserBlog()->getAvatar()?>" width="20"/><strong><?= htmlspecialchars($postblog->getUserBlog()->getPseudo()) ?>
</strong> le <?= $postblog->getPostDate() ?> </p>
<?php
if($_SESSION['id_userblog'] == $postblog->getUserBlog()->getId())
{
?>
<a href="index.php?ctrl=home&action=displayOneComment&id=<?= $postblog->getId()?>"> (modifier) </a>
<?php
}
?>
<P>(dernière modification le <?= $postblog->getDateModif() ?>)</P>
</br>
<?php

}
    }
?>

