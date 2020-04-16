<?php
$topic = $result["data"]["topic"];
$postblogs = $result["data"]["postblog"];
// var_dump ($result["data"]);die;

?>   
<h1>Posts du Topic!</h1>
<p><a href="index.php?ctrl=home&action=affichetopics&id="<?= $_SESSION['id_userblog']; ?>>Retour à la liste des Topics</a></p>


<div class="news">
    <h3>
        <?= htmlspecialchars($topic->getTitle()) ?> crée par <?= $topic->getUserBlog()->getPseudo()?>
        <em> le <?= $topic->getTopicDate() ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($topic->getContent())) ?>
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
<p><strong><?= htmlspecialchars($postblog->getUserBlog()->getPseudo()) ?>
</strong> créé le <?= $postblog->getPostDate() ?><a href="index.php?ctrl=home&action=displayOneComment&id=<?= $postblog->getId()?>"> (modifier) </a> </p>
<P>(dernière modification le <?= $postblog->getDateModif() ?>)</P> 
<p><?= nl2br(htmlspecialchars($postblog->getPost())) ?></p>
<?php
}
    }
?>

