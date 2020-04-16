<?php $title = 'Modification de commentaire'; ?>
 
<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<p><strong>Commentaire à modifier</strong></p>
 
<p><strong><?= htmlspecialchars($oneComment['author']) ?>
</strong> le <?= $oneComment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($oneComment['comment'])) ?></p>

<h2>Modification du commentaire</h2>
<!-- modif 2 apportée mercredi soir 22 05 19 : post_id au lieu d'id pour le lien ci-dessous : -->
<form action="index.php?action=changeComment&amp;id=<?= $_GET['id'];?>" method="post">
 
    <!--<div> -->
        <!-- modif 1 apportée mercredi soir 22 05 19 : ajout de la demande de l'id du post dans le formulaire : champs à mettre en hidden peut être plus tard  -->
      <!--  <label for="post_id">Identifiant du billet</label> <br/>
         <input type="text" id="post_id" name="post_id" />
    </div> -->
 
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
        <input type="hidden" name="sujetId" value="<?= $_GET['postid'] ?>"/>
    </div>
 
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?=$oneComment['comment']?></textarea>
    </div>
 
    <div>
        <input type="submit"/>
    </div>
</form>
 
 
 
<?php $content = ob_get_clean(); ?>
 
<?php require(FRONTEND_DIR.'template.php'); ?>