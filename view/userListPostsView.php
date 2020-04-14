
<?php
$data=$result['data'];
foreach($data as $data)
{
?>   


<h1>Bonjour</h1>
<p>Derniers billets du blog :</p>
 

<?php
// while ($data = $posts->fetch()){
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
?>
<form action="index.php?action=addTopic" method="post">
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
