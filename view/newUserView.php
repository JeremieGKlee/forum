

<h3>Page pour créer un nouveau compte</h3>
<h3>Inscription</h3>


<div>
<form action="" method="post">
    <p>
        <label for="pseudo">Votre Pseudo :</label>
        <input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>">
    </p>
    <p>
        <label for="email">Votre adresse mail:</label>
        <input id="email" type="email" name="email" placeholder="Votre mail" value="<?php if(isset($email)) {echo $email;} ?>">
    </p>
        <label for="email2">Confirmation de votre adresse mail:</label>
        <input id="email2" type="email" name="email2" placeholder="Confirmez votre mail" value="<?php if(isset($email2)) {echo $email2;} ?>" >

    <p>
        <label for="mdp">Mot de passe :</label>        
        <input id="mdp" type="password" name="mdp" placeholder="Votre mot de passe" />
    </p>
    <p>
        <label for="mdp2">Confirmation de votre mot de passe :</label>        
        <input  id="mdp2" type="password" name="mdp2" placeholder="Confirmez votre mot de passe" />
    </p>
    <p>
    <input type="checkbox" name="case1" id="case1" /> <label for="case1">J'ai lu et j'accepte les conditions générales d'utilisation et la politique d'utilsation des données.</label>
    </p>
    <p>
    <input type="checkbox" name="case2" id="case2" /> <label for="case2">Je souhaite recevoir la newsletter de Mon petit Forum Muselé.</label>
    </p>


    <p>  <input type="submit" name="envoi-reussi" value="Envoi" />
    <p>
</form>

</div>



