<?php
    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use Model\Managers\PostblogManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserblogManager;
    
    class SecureController extends AbstractController
    {

        public function signup()
        {
            if(isset($_POST['envoi-reussi']))
            {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{4,}/')
                    )
                );
                $email = htmlspecialchars($_POST['email']);
                
                $email2 = htmlspecialchars($_POST['email2']);

                $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
                                    
                if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['email2'])
                 AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['case1']))
                {
                    $pseudolenght = strlen($pseudo);
                    if($pseudolenght <= 20)
                    {
                        $manager= new UserblogManager();
                        
                        if($manager->nicknameAlreadyUsed($pseudo) == 0)
                        {
                            if($email == $email2)
                            {
                                if(filter_var($email,FILTER_VALIDATE_EMAIL))
                                {             
                                    if($manager->mailAlreadyUsed($email) == 0)
                                    {
                                        if( $_POST['mdp'] == $_POST['mdp2'])
                                        {
                                            $newuser = 
                                                [
                                                "pseudo"    => $pseudo,
                                                "role" => json_encode(['ROLE_USER']),
                                                "email"     => $email,
                                                "mdp"       => $mdp,                                                
                                                ];
                                            $manager->add($newuser);
                                            Session ::addFlash("success", "Acceptation de votre demande");
                                            $this->redirectTo("secure", "signin");
                                        }
                                        else
                                        {
                                            Session ::addFlash("error", "La confirmation de votre mot de passe ne correspond pas");
                                        }
                                    }
                                    else
                                    {
                                        Session ::addFlash("error", "Adresse mail déjà utilisée");
                                    }
            
                                }
                                else
                                {
                                    Session ::addFlash("error", "Votre adresse mail n'est pas valide");
                                }
                            }
                            else
                            {
                                Session ::addFlash("error", "La confirmation de votre adresse mail n'est pas identique");
                            }
                        }
                        else
                        {
                            Session ::addFlash("error", "Le pseudo choisi existe déjà");
                        }
                    }
                    else
                    {
                        Session ::addFlash("error", "Votre pseudo est trop long, il ne doit pas dépasser 20 caractères");
                    }
                }
                else
                {
                    Session ::addFlash("error", "Tous les champs doivent être remplis!");
                }
            }
            return ["view" => VIEW_DIR."newUserView.php"];
        }

        public function signin()
        {   
            
            if(isset($_POST['formconnexion']))
            {
                $pseudo =htmlspecialchars($_POST['pseudo']);
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{4,}/')
                    )
                );
                if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))
                {
                    $manager= new UserblogManager();
                    
                    if($manager->nicknameAlreadyUsed($pseudo) == 0)
                        {
                            Session ::addFlash("error", "Pseudo non reconnu");
                        }
                        else
                        {
                        $manager= new UserblogManager();
                        $user = $manager->findByPseudo($pseudo);
                        $mdp = $manager->retrievePassword($pseudo);
                    
                            if(password_verify($_POST['mdp'],$mdp))
                            {
                            $manager= new UserblogManager();
                            $userblog = $manager->sessionopen($pseudo);
                            Session::addFlash("success", "Vous êtes connectés, bienvenue !");
                            $_SESSION['id_userblog'] = $userblog['id_userblog'];
                            $_SESSION['pseudo'] = $userblog['pseudo'];
                            $_SESSION['email'] = $userblog['email'];
                            $_SESSION['avatar'] = $userblog['avatar'];
                            $this->redirectTo("home", "affichetopics");
                            }
                            else
                            {
                                Session ::addFlash("error", "Mot de passe non reconnu");
                            }
                        }
                }
                else
                {
                    Session ::addFlash("error", "Tous les champs ne sont pas remplis");
                }
            
           }
            return ["view" => VIEW_DIR."connectCreateView.php"];
        }

        public function displayprofil()
        {            
            $id = $_SESSION['id_userblog'];
    
            $manager = new UserblogManager();
    
            $profil = $manager->findOneById($id);
            return
                [
                    "view" => VIEW_DIR."profilView.php",
                    "data" => $profil
                ];
        }

        public function modifyprofil()
        {   
            $id = $_SESSION['id_userblog'];
            $manager = new UserblogManager();
            $profil = $manager->findOneById($id);
            
            if(isset($_SESSION['id_userblog']))
            {
                $user = $manager->userProfil($id);

                if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
                {
                    $newpseudo = htmlspecialchars($_POST['newpseudo']);
                    $insertpseudo = $manager -> changePseudo($newpseudo,$id);

                    $this->redirectTo("secure", "displayprofil");

                    
                }

                if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
                {
                    $newmail = htmlspecialchars($_POST['newmail']);
                    $newmail2 = htmlspecialchars($_POST['newmail2']);
                    if( $_POST['newmail'] == $_POST['newmail2'])
                    {
                        if(filter_var($newmail,FILTER_VALIDATE_EMAIL))
                        {
                            $insertmail = $manager -> changeMail($newmail,$id);
                           
                            $this->redirectTo("secure", "displayprofil");
                        }
                        else
                        {
                            Session ::addFlash("error", "Votre adresse mail n'est pas valide");
                        }       
                    }
                    else
                    {
                        Session ::addFlash("error", "Vos 2 mails ne sont pas identiques");
                    }
                }

                if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
                {
        
                    $newmdp1 = password_hash($_POST['newmdp1'],PASSWORD_DEFAULT);
                    $newmdp2 = password_hash($_POST['newmdp2'],PASSWORD_DEFAULT);

                    if( $_POST['newmdp1'] == $_POST['newmdp2'])
                    {
                        $insertmdp = $manager -> changeMdp($newmdp1,$id);
                        $this->redirectTo("secure", "displayprofil");
                    }
                    else
                    {
                        Session ::addFlash("error", "Vos 2 mots de passe ne sont pas identiques");
                    }
        
                }

                if( isset($_FILES['avatar']) and !empty($_FILES['avatar']['name']))
                {
                    $sizeMax = "2097152‬";
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if ($_FILES['avatar']['size'] <= $sizeMax)
                    {
                        $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1));
                        if (in_array($extension_upload, $extensions_autorisees))
                        {
                            $chemin = "./public/img/avatars/".$_SESSION['id_userblog'].".".$extension_upload;
                            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if($resultat)
                            {
                                $avatar = $_SESSION['id_userblog'].".".$extension_upload;
                                $insertAvatar = $manager-> changeAvatar($avatar,$id);
                                $this->redirectTo("secure", "displayprofil");
                            }
                            else
                            {
                                Session ::addFlash("error", "Désolé l'image de votre Avatar n'a pu être téléchargé");
                            }
                        }
                        else
                        {
                            Session ::addFlash("error", "Votre image doit être au format .jpg ou .jpeg ou .gif ou .png");
                            
                        }
                    }
                    else
                    {
                        Session ::addFlash("error", "Votre image ne doit pas dépasser 2 Mo");
                    }
                }

                return
                [
                    "view" => VIEW_DIR."modifProfilView.php",
                    "data" => $profil
                ];
            
            }
            
            
        }

        public function hacker()
        {
            return ["view" => VIEW_DIR."prohibitedView.php"];
        }
        
        
        public function logout()
        {
            return ["view" => VIEW_DIR."byebyeView.php"];
        }
    }

    
