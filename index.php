<?php
    namespace App;

    

    define('DS', DIRECTORY_SEPARATOR); // le caractère séparateur de dossier (/ ou \)
    // meilleure portabilité sur les différents systêmes.
    define('BASE_DIR', dirname(__FILE__).DS); // pour se simplifier la vie
    define('VIEW_DIR', BASE_DIR."view/");     //le chemin où se trouvent les vues
    define('PUBLIC_DIR', BASE_DIR."public/");     //le chemin où se trouvent les fichiers publics (CSS, JS, IMG)

    require("app/Autoloader.php");

    Autoloader::register();
    
    //démarre une session ou récupère la session actuelle
    session_start();
    //et on intègre la classe Session qui prend la main sur les messages en session
    use App\Session as Session;

//---------REQUETE HTTP INTERCEPTEE-----------

    //ex : index.php?ctrl=home
    if(isset($_GET['ctrl'])){
        $ctrlname = $_GET['ctrl'];
    }
    else $ctrlname = "home";

    //Controller/HomeController
    $ctrlname = "Controller".DS.ucfirst($ctrlname)."Controller";

    $ctrl = new $ctrlname();
    
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else $action = "index";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else $id = null;

    $result = $ctrl->$action($id);
    
    /*--------CHARGEMENT PAGE----------*/
    
    if($action == "ajax"){//si l'action était ajax
        echo $result;//on affiche directement le return du contrôleur (càd la réponse HTTP sera uniquement celle-ci)
    }
    else{
        ob_start();//démarre un buffer (tampon de sortie)
        /*la vue s'affiche dans le buffer qui devra être inséré
        au milieu du template*/
        include($result['view']);
        /*je mets cet affichage dans une variable*/
        $page = ob_get_contents();
        /*j'efface le tampon*/
        ob_end_clean();
        /*j'affiche le template principal*/
        include VIEW_DIR."layout.php";
    }
    

