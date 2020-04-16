<?php

?>
<h1>Bienvenue sur mon petit Forum Muselé</h1>
<h3>Merci de vous connecter ou créer un nouveau compte</h3>



<div>
<form action="" method="post">
    <p>
        <label for="pseudo">Votre Pseudo :</label>
        <input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo"/>
    </p>
        <label for="mdp">Votre mot de passe :</label>        
        <input id="mdp" type="password" name="mdp" placeholder="Votre mot de passe" />
    </p>
    
    <p>
        <input type="submit" name="formconnexion" value="Se connecter" />
    <p>
</form>
<p>
<a href="index.php?ctrl=secure&action=signup">Vous pouvez en créer un compte, ici!!</a>
</p>
</div>



