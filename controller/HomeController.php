<?php
    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use Model\Managers\PostblogManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserblogManager;
    
    class HomeController extends AbstractController
    {

        public function index(){

            return [
                "view" => VIEW_DIR."firstView.php",
                
            ];
        }

        public function affichetopics()
        {

            $tman = new TopicManager();
           
            $topics = $tman->findAll();


            return [
                "view" => VIEW_DIR."userListTopicsView.php",
                "data" => [
                    "topic" => $topics,
                    
                ]
            ];
        }

        
        public function ajouteTopic()
        {
        $tman = new TopicManager();
        $userblog = $_SESSION['id_userblog'];
        $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        // $content =  htmlspecialchars($_POST['content']);
        // $content = filter_var($_POST['content'],FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST,'content',FILTER_SANITIZE_STRING);

        $newtopic =
            [
                "title" => $title,
                "content" => $content,
                "userblog_id" => $userblog,
            ]
            ;
            $tman->add($newtopic);
    
            if ($tman === false)
            {
                Session::addFlash("error", "Impossible d'ajouter le topic !");
            }
            else
            {
                // header('location:index.php?ctrl=home&action=affichetopics&id=');
                $this->redirectTo("home", "affichetopics");
            }
            return ["view" => VIEW_DIR."userListTopicsView.php"];
        }

        public function affichePostsTopic()
        {
            
            $idtopic = $_GET['id'];
            $tman = new TopicManager();
            $pbman = new PostblogManager();
           
            $topic = $tman->findOneById($idtopic);
            // var_dump($topic);
            $postblogs = $pbman->findByTopic($idtopic);
            // var_dump($postblogs);
            return 
            [
                "view" => VIEW_DIR."userPostsView.php",
                "data" => [
                    "topic" => $topic,
                    "postblog" => $postblogs,
                    
                ]
            ];
        }

        public function ajoutePost()
        {
        $pbman = new PostblogManager();
        $userblog = $_SESSION['id_userblog'];
        $topic = $_GET['id'];
        $comment = filter_input(INPUT_POST,'comment',FILTER_SANITIZE_STRING);
        $newPost =
            [
                "post" => $comment,
                "userblog_id" => $userblog,
                "topic_id" => $topic,
            ]
            ;
            // var_dump($newPost);die;
            $pbman->add($newPost);
    
            if ($pbman === false)
            {
                Session::addFlash("error", "Impossible d'ajouter le post !");
            }
            else
            {
                // header('location:index.php?ctrl=home&action=affichePostsTopic&id='.$_GET['id']);
                $this->redirectTo("home", "affichePostsTopic",$_GET['id']);
            }
            return ["view" => VIEW_DIR."userPostsView.php"];
        }

        public function displayOneComment() //pour afficher le commentaire selectionné pour affichage avant modif
        {
            $id = $_GET['id'];
            $pbman = new PostblogManager();
            $post = $pbman->findOneById($id);
    
            return
                [
                    "view" => VIEW_DIR."modifCommentView.php",
                    "data" => $post
                ];
    
        }

        function changeComment($id, $author, $comment) // pour modifier un commentaire
        {
            $commentManager =new \OpenClassrooms\Blog\Model\CommentManager(); //Création d'un objet
            $affectedComment = $commentManager ->modifComment($id, $author, $comment);
            if ($affectedComment === false) {
                throw new Exception('Impossible de modifier le commentaire !');
                
            }
            else {
                header('Location: index.php?action=post&id='. $_POST['sujetId']);
            }

        }

        public function voir($id){
            
            $man = new VehiculeManager();

            $vehicule = $man->findOneById($id);

            return [
                "view" => VIEW_DIR."voir.php",
                "data" => $vehicule
            ];
        }

        public function new(){

            if(!empty($_POST)){

                $data["immat"]     = $_POST['immat'];
                $data["modele"]    = $_POST['modele'];
                $data["marque_id"] = $_POST['marque'];
                $data["nb_portes"] = $_POST['nbportes'];

                if( $data["immat"] !== "" && $data['modele'] !== ""){
                    
                    $man = new VehiculeManager();

                    //si l'ajout s'effectue correctement (càd que le DAO a renvoyé l'id de ce qu'on a inséré en base
                    if($idNewVoiture = $man->add($data)){
                        //on met un message de succès en session
                        Session::addFlash("success", "VOITURE AJOUTEE AVEC SUCCES !");
                        //et on redirige (via une redirect 302 serveur) vers une toute nouvelle requète
                        //pour ne plus avoir de refresh de POST
                        header("Location:index.php?ctrl=home&action=voir&id=".$idNewVoiture);
                        //TRES IMPORTANT, il faut arrêter l'exécution de la suite du script !
                        //même si on a fait une redirection, le script s'exécute jusqu'au bout...
                        die();
                    }
                    else{
                        //on met un message d'erreur en session (cas où l'ajout ne s'est pas effectué en base)
                        Session::addFlash("error", "UN PROBLEME EST SURVENU... !!!!");
                    }
                }
                else{
                    //on met un message d'erreur en session (cas où le formulaire n'est pas bien rempli)
                    Session::addFlash("error", "LES CHAMPS OBLIGATOIRES SONT VIDES !!!!");
                }
            }
            //s'il n'y a pas eu de redirection, on va jusqu'à l'affichage du formulaire quoi qu'il arrive
            $mman = new MarqueManager();
            $marques = $mman->findAll();

            return [
                "view" => VIEW_DIR."form.php",
                "data" => $marques
            ]; 
            
            
        }

        public function listeParMarque($idmarque){
            
            $vman = new VehiculeManager();
            $mman = new MarqueManager();

           
            $marque = $mman->findOneById($idmarque);
            $vehicules = $vman->findByMarque($idmarque);

            return [
                "view" => VIEW_DIR."liste-marque.php",
                "data" => [
                    "marque" => $marque,
                    "vehicules" => $vehicules
                ]
            ];
        }

    }
