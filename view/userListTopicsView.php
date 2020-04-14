
<?php
$topics = $result["data"]["topic"];
?>   


<h1>Bonjour <?= $_SESSION['pseudo'] ?></h1>
<h3>Derniers Topics du Forum :</h3>
<?php

    if(!empty($topics))
    {
        foreach($topics as $topic){

?> 

    <div class="news">
        <h3>
            <?= htmlspecialchars($topic->getTitle()) ?>
            <em>le <?= $topic->getTopicDate() ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($topic->getContent())) ?>
            <br />
            <em><a href="index.php?ctrl=home&amp;action=affichePostsTopic&amp;id=<?= $topic->getId() ?>">Posts</a></em>
        </p>
    </div>
<?php
        }
    }
    else echo "<p>Pas de véhicules disponibles...</p>";
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
