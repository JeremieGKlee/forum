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
            if(!empty($_POST['title']) AND !empty($_POST['content']))
            {
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
            }
            else
            {
                Session ::addFlash("error", "Tous les champs doivent être remplis!");
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

        public function ajoutePost($idtopic)
        {
        $topicManager = new TopicManager();
        $pbman = new PostblogManager();
        $userblog = $_SESSION['id_userblog'];
        $idtopic = $_GET['id'];
            if(!empty($_POST['comment']) && $topicManager ->isClosed($idtopic))
            {
                $comment = filter_input(INPUT_POST,'comment',FILTER_SANITIZE_STRING);
                $newPost =
                    [
                        "post" => $comment,
                        "userblog_id" => $userblog,
                        "topic_id" => $idtopic,
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
            }
            else
            {
                Session ::addFlash("error", "Le champs commentaire est vide!");
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

        function changePost() // pour modifier un commentaire
        {
            $id = $_GET['id'];
            $id2 = $_GET['id2'];
            $pbman = new PostblogManager(); //Création d'un objet
            if(!empty($_POST['post']))
            {
                $post = filter_input(INPUT_POST,'post',FILTER_SANITIZE_STRING);
                $insertpost =$pbman ->modifPost($post, $id);
                // var_dump($insertpost);die;
                if ($insertpost === false)
                {
                Session::addFlash("error", "Impossible de modifier le commentaire !");    
                }
            }
            else
            {
                Session::addFlash("error", "le Champ de modification est vide, vous n'avez rien modifié!");
                $this->redirectTo("home", "affichePostsTopic",$id2);
            }
                // header('Location: index.php?action=post&id='. $_POST['sujetId']);
                Session::addFlash("success", "Votre post a bien été modifié!");
                $this->redirectTo("home", "affichePostsTopic",$id2);

        }

        // public function closeTopic($topic)
        // {
        //     $topicManager = new TopicManager();
        //     $closeNumber = ($topicManager ->isClosed($topic)) ? "0" : "1";
        //     if($topicManager -> close($topic, $closeNumber))
        //     {
        //         if($closeNumber == "1")
        //         {
        //             Session::addFlash("success", "Sujet verrouillé");
        //         }
        //         if($closeNumber == "0")
        //         {
        //             Session::addFlash("success", "Sujet déverrouillé");
        //         }
        //     }
        //     else
        //     {
        //         Session::addFlash("error", "Sujet impossible à verrouiller");
        //     }
        //     $this->redirectTo("home", "affichePostsTopic",$topic);
        // }

        public function closeTopic($idtopic)
        {
            $topicManager = new TopicManager();
            $topic = $topicManager-> findOneById($idtopic);
            // if(App\Session::isAdmin() || $_SESSION['id_userblog'] == $topic->getUserBlog()->getId())
            // {
            if($_SESSION['id_userblog'] == $topic->getUserBlog()->getId())
            {

                $closeNumber = ($topic ->getClosed($idtopic)) ? "0" : "1";
                if($topicManager -> close($idtopic, $closeNumber))
                {
                    if($closeNumber == "1")
                    {
                        Session::addFlash("success", "Sujet verrouillé");
                    }
                    if($closeNumber == "0")
                    {
                        Session::addFlash("success", "Sujet déverrouillé");
                    }
                }
            }
            else
            {
                Session::addFlash("error", "Aucune action possible");
            }
            $this->redirectTo("home", "affichePostsTopic",$idtopic);
        }

    }
