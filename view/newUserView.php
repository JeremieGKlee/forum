<?php
$pseudo = isset( $_POST['pseudo'] ) ?  $_POST['pseudo'] : NULL;
$email = isset( $_POST['email'] ) ?  $_POST['email'] : NULL;
$email2 = isset( $_POST['email2'] ) ?  $_POST['email2'] : NULL;
?>

<h1>Un petit effort pour arriver sur mon petit Forum Muselé</h1>


<div>
<form action="" method="post">
    <p>
        <label for="pseudo">Votre Pseudo :</label>
        <input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" required>
    </p>
    <p>
        <label for="email">Votre adresse mail:</label>
        <input id="email" type="email" name="email" placeholder="Votre mail" value="<?php if(isset($email)) {echo $email;} ?>" required>
    </p>
        <label for="email2">Confirmation de votre adresse mail:</label>
        <input id="email2" type="email" name="email2" placeholder="Confirmez votre mail" value="<?php if(isset($email2)) {echo $email2;} ?>" required>

    <p>
        <label for="mdp">Mot de passe :</label>        
        <input id="mdp" type="password" name="mdp" placeholder="Votre mot de passe" required/>
    </p>
    <p>
        <label for="mdp2">Confirmation de votre mot de passe :</label>        
        <input  id="mdp2" type="password" name="mdp2" placeholder="Confirmez votre mot de passe" required/>
    </p>
    <p>
    <input type="checkbox" name="case1" id="case1" required/> <label for="case1">J'ai lu et j'accepte les conditions générales d'utilisation et la politique d'utilsation des données.</label>
    </p>
    <p>
    <input type="checkbox" name="case2" id="case2" /> <label for="case2">Je souhaite recevoir la newsletter de Mon petit Forum Muselé.</label>
    </p>


    <p>  <input type="submit" name="envoi-reussi" value="Envoi" />
    <p>
</form>

</div>



