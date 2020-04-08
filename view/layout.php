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
</head>
<body>
    <div id="wrapper"> 
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 id="message" style="color: red">
                //?= App\Session::getFlash("error") ?>
            </h3>
            <h3 id="message" style="color: green">
                //?= App\Session::getFlash("success") ?>
            </h3>
            <header>
                <nav>
                
                    <a href="index.php">Accueil</a>
                    <a href="index.php?ctrl=home&action=search">Recherche</a>
                    <a href="index.php">New Topic</a>
                    <a href="index.php?ctrl=home&action=new">Admin</a>
                    <a href="index.php">New Post</a>
                    <a href="index.php?ctrl=home&action=new">Avatar</a>
                    <a href="index.php">Pseudo</a>
                    <a href="index.php?ctrl=home&action=new">Deconnexion</a>
                
                </nav>
            </header>
            
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