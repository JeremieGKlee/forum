<?php
    namespace Controller;

    use App\Session;
    use Model\Managers\PostblogManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserblogManager;
    
    class HomeController{

        public function index(){

            return [
                "view" => VIEW_DIR."firstView.php",
                
            ];
        }

        public function affichetopics(){

            $tman = new TopicManager();
           
            $topics = $tman->findAll();


            return [
                "view" => VIEW_DIR."userListTopicsView.php",
                "data" => [
                    "topic" => $topics,
                    
                ]
            ];
        }

        public function affichePostsTopic(){

            $id = $_GET['id'];
            $tman = new TopicManager();
            $pbman = new PostblogManager();
           
            $topic = $tman->findOneById($id);
            $postblogs = $pbman->findAll();
            foreach($postblogs as $value){
                var_dump($value);die;
            }
{

            return [
                "view" => VIEW_DIR."userPostsView.php",
                "data" => [
                    "topic" => $topic,
                    "postblog" => $postblogs,
                    
                ]
            ];
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
