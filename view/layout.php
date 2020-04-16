<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>Mon petit Forum Muselé</title>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper"> 
        <div id="mainpage">
           
            <header>
                <nav>
                
                   
                    <?php
                    if(isset($_SESSION['id_userblog']))
                    {
                    ?>
                    <a href="index.php?ctrl=home&action=affichetopics&id="<?= $_SESSION['id_userblog']; ?>>Accueil</a>
                    <!-- <a href="index.php?ctrl=home&action=search">Recherche</a> -->
                    <!-- <a href="index.php">New Topic</a> -->
                    <a href="index.php?ctrl=secure&action=admin">Admin</a>
                    <!-- <a href="index.php">New Post</a> -->
                    <a href="">Avatar</a>
                    <a href="index.php?ctrl=secure&action=displayprofil&id="<?= $_SESSION['id_userblog']; ?>>Pseudo</a>
                    <a href="index.php?ctrl=secure&action=logout">Deconnexion</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="index.php">Accueil</a>
                    <a href="index.php?ctrl=secure&action=signin">Connexion</a>
                    <?php
                    }
                    ?>
                    
                    
                    
                
                </nav>
            </header>
             <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
             <h3 id="message" style="color: red">
                <?= App\Session::getFlash("error") ?>
            </h3>
            <h3 id="message" style="color: green">
                <?= App\Session::getFlash("success") ?>
            </h3>
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum Jérémie !</p>
            
        </footer>
    </div>
    
</body>
</html>