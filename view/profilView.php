<?php
session_start();
?>

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

<h3>Page pour modifier son profil</h3>
<h3>Profil</h3>

<?php
$db = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser =$db->prepare("SELECT * FROM userblog WHERE id_user = ? ");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();


?>
<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
<div>
    <p>
    Pseudo : <?php echo $userinfo['pseudo']; ?>
    </p>
    Mail : <?php echo $userinfo['email']; ?>
    <p>
</br>
<?php
if(isset($_SESSION['id_user']) AND ($userinfo['id_user'] == $_SESSION['id_user']))
{
?>
<a href="modifProfilView.php">Modifiez mon profil</a>
<a href="byebyeView.php">Se déconnecter</a>
<?php
}
else
{
$erreur = "Vous n'êtes pas autorisé à continué sur cette page";
header("location:byebyeView.php");
}
?>
     
</div>
<?php
}
if(isset($erreur))
{
    echo $erreur;
}

?>


