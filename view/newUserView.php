

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>FORUM</title>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
</head><?php
    // $marques = $result["data"];
?>

<h3>Page pour créer un nouveau compte</h3>
<h3>Inscription</h3>

<?php
$db = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

if(isset($_POST['envoi-reussi']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    $mdp2 = password_hash($_POST['mdp2'],PASSWORD_DEFAULT);
        
    if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['email2'])
     AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['case1']))
    {
        $pseudolenght = strlen($pseudo);
        if($pseudolenght <= 20)
        {
            $reqpseudo = $db->prepare("SELECT * FROM userblog WHERE pseudo = ? ");
            $reqpseudo->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            if($pseudoexist == 0)
            {    
                if($email == $email2)
                {
                    if(filter_var($email,FILTER_VALIDATE_EMAIL))
                    {
                        $reqmail = $db->prepare("SELECT * FROM userblog WHERE email = ? ");
                        $reqmail->execute(array($email));
                        $emailexist = $reqmail->rowCount();
                        if($emailexist == 0)
                        {
                            if( $_POST['mdp'] == $_POST['mdp2'])
                            {
                                
                                $insertNewUser = $db->prepare('INSERT INTO userblog(pseudo, email, mdp, userblogdate) VALUES(?,?,?,NOW())');
                                $insertNewUser->execute(array($pseudo, $email, $mdp));
                                
                                // var_dump($_POST);
                                // var_dump($insertNewUser);die;
                                $erreur = "Acceptation de votre demande";
                                // $_SESSION['comptecree'] = "Acceptation de votre demande";
                                header('location:connectCreateView.php');
                            }
                            else
                            {
                                $erreur = "La confirmation de votre mot de passe ne correspond pas";
                            }
                        }
                        else
                        {
                            $erreur = "Adresse mail déjà utilisée";
                        }

                    }
                    else
                    {
                        $erreur = "Votre adresse mail n'est pas valide";
                    }
                }
                else
                {
                    $erreur = "La confirmation de votre adresse mail n'est pas identique";
                }
            }
            else
            {
                $erreur = "Le pseudo choisi existe déjà";
            }
        }
        else
        {
            $erreur = "Votre pseudo est trop long, il ne doit pas dépasser 20 caractères";
        }
    }
    else
    {
        $erreur ="Tous les champs doivent être remplis!";
    }
}

?>
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
<?php
if(isset($erreur))
{
    echo $erreur;
}
?>
</div>



