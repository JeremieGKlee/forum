<?php
$topic = $result["data"]["topic"];
$postblogs = $result["data"]["postblog"];
// var_dump ($result["data"]);die;

?>   
<h1>Posts du Topic!</h1>
<p><a href="index.php?ctrl=home&action=affichetopics&id="<?= $_SESSION['id_userblog']; ?>>Retour à la liste des Topics</a></p>




    <h2><?= filter_var($topic->getTitle(),FILTER_SANITIZE_STRING) ?> <?= $topic->getClosed() ? "(- Topic verrouillé)" : "" ;?></h2>
    <h3>
        Crée par <img src="./public/img/avatars/<?php echo $topic->getUserBlog()->getAvatar()?>" width="20"/><?= $topic->getUserBlog()->getPseudo()?>
        <?php
            // if(App\Session::isAdmin() || $_SESSION['id_userblog'] == $topic->getUserBlog()->getId())
            // {
            if($_SESSION['id_userblog'] == $topic->getUserBlog()->getId())
            {
        ?>        
            <a href="index.php?ctrl=home&action=closeTopic&id=<?= $topic->getId()?>">
            <?= $topic -> getClosed() ? "- Déverrouiller" : "- Verrouiller" ?>
            </a>
        <?php
            }
        ?>
        </h3>
    <em> le <?= $topic->getTopicDate() ?></em>
    
    <p>
        <?= nl2br(filter_var($topic->getContent()),FILTER_SANITIZE_STRING) ?>
    </p>

</br>
<h3>Commentaires</h3>

<?php
    if($topic->getClosed())
    {
        ?>
        <p>Topic verouillé</p>
        <?php
    }
    else
    {
        ?>
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
    }
    ?>

<?php
// while ($comment = $comments->fetch())
if(!empty($postblogs))
{
    foreach($postblogs as $postblog)
{
?>
<h3><?= nl2br(filter_var($postblog->getPost()),FILTER_SANITIZE_STRING) ?><?php
if($_SESSION['id_userblog'] == $postblog->getUserBlog()->getId())
{
?>
<a href="index.php?ctrl=home&action=displayOneComment&id=<?= $postblog->getId()?>&id2=<?= $postblog->getTopic()->getId()?>"> (modifier) </a>
<?php
}
?>
</h3>
<h4>
Créé par <img src="./public/img/avatars/<?php echo $postblog->getUserBlog()->getAvatar()?>" width="20"/><strong><?= htmlspecialchars($postblog->getUserBlog()->getPseudo()) ?>
</h4>
<p></strong> le <?= $postblog->getPostDate() ?> </p>
<P>(dernière modification le <?= $postblog->getDateModif() ?>)</P>
</br>
<?php

}
    }
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
