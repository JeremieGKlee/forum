<?php
$post = $result["data"];
// var_dump($post);die;
?>
 
<?php
?>
<h1>Mon petit Forum Muselé</h1>
<p><a href="index.php?ctrl=home&action=affichePostsTopic&id=<?=$post->getTopic()->getId()?>">Retour à la liste des posts</a></p>
<p><strong>Commentaire à modifier</strong></p>
 
<p><strong>Créé par <?= htmlspecialchars($post->getUserblog()->getPseudo()) ?>
</strong> le <?= $post->getpostDate() ?></p>
    <p><?= nl2br(filter_var($post->getPost()),FILTER_SANITIZE_STRING)?></p>

<h2>Modification du commentaire</h2>
<!-- modif 2 apportée mercredi soir 22 05 19 : post_id au lieu d'id pour le lien ci-dessous : -->
<!-- <form action="index.php?action=changePost&id=< $_GET['id']?>" method="post"> -->
<form action="index.php?action=changePost&id=<?= $_GET['id']?>&id2=<?= $_GET['id2']?>" method="post">
 
    <!--<div> -->
        <!-- modif 1 apportée mercredi soir 22 05 19 : ajout de la demande de l'id du post dans le formulaire : champs à mettre en hidden peut être plus tard  -->
      <!--  <label for="post_id">Identifiant du billet</label> <br/>
         <input type="text" id="post_id" name="post_id" />
    </div> -->
 
    <div>
        
    </div>
 
    <div>
        <label for="post">Post à modifier</label><br />
        <textarea id="post" name="post"><?=$post->getPost()?></textarea>
    </div>
 
    <div>
        <input type="submit"/>
    </div>
</form>
<?php
// if(isset($_SESSION['id_userblog']) AND ($_GET['id'] == ""))
if($_SESSION['id_userblog'] != ($post->getUserblog()->getId()))
// if(isset($_SESSION['id_userblog']))
    {
        header('location:index.php?ctrl=secure&action=hacker');
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