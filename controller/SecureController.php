<?php
    namespace Controller;

    use App\Session;
    use Model\Managers\UserblogManager;
    
    class SecureController
    {

        public function signup()
        {
            //$db = new \PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
            //$db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

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
                        $tab = $manager->nicknameAlreadyUsed($pseudo);
                        if(in_array(0, $tab))
                        {
                        // $reqpseudo = $db->prepare("SELECT * FROM userblog WHERE pseudo = ? ");
                        // $reqpseudo->execute(array($pseudo));
                        // $pseudoexist = $reqpseudo->rowCount();
                        // if($pseudoexist == 0)
                        // {    
                            if($email == $email2)
                            {
                                if(filter_var($email,FILTER_VALIDATE_EMAIL))
                                {
                                    $tab = $manager->mailAlreadyUsed($email);
                                    if(in_array(0, $tab))
                                    {
                                    // $reqmail = $db->prepare("SELECT * FROM userblog WHERE email = ? ");
                                    // $reqmail->execute(array($email));
                                    // $emailexist = $reqmail->rowCount();
                                    // if($emailexist == 0)
                                    // {
                                        if( $_POST['mdp'] == $_POST['mdp2'])
                                        {
                                            $newuser = 
                                                [
                                                "pseudo" => $pseudo,
                                                "email" => $email,
                                                "mdp" => $mdp,
                                                ];
                                            $manager->add($newuser);
                                            // var_dump($newuser);die;

                                            // $insertNewUser = $db->prepare('INSERT INTO userblog(pseudo, email, mdp, userblogdate) VALUES(?,?,?,NOW())');
                                            // $insertNewUser->execute(array($pseudo, $email, $mdp));
                                            
                                            // var_dump($_POST);die;
                                            // var_dump($insertNewUser);die;
                                            Session ::addFlash("success", "Acceptation de votre demande");
                                            // $_SESSION['comptecree'] = "Acceptation de votre demande";
                                            header('location:index.php?ctrl=secure&action=signin');
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
                    $tab = $manager->nicknameAlreadyUsed($pseudo);
                        if(in_array(0, $tab))
                        {
                            Session ::addFlash("error", "Pseudo non reconnu");
                        }
                        else
                        {
                        $manager= new UserblogManager();
                        $user = $manager->findByPseudo($pseudo);
                        $mdp = array_values($manager->retrievePassword($pseudo));
                    
            
                            if(password_verify($_POST['mdp'],$mdp[0]))
            
                            {
                            $manager= new UserblogManager();
                            $userinfo = $manager->sessionopen($pseudo);
                        
                            $_SESSION['id_userblog'] = $userinfo['id_userblog'];
                            $_SESSION['pseudo'] = $userinfo['pseudo'];
                            $_SESSION['email'] = $userinfo['email'];
                            header('location:index.php?ctrl=home&action=affichetopics&id='.$_SESSION['id_userblog']);

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
            // var_dump($id);die;
            // var_dump($_SESSION);die;
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
            // var_dump($_SESSION);die;
           


            $db = new \PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
            $db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            if(isset($_SESSION['id_userblog']))
            {
                $requser = $db->prepare("SELECT * FROM userblog WHERE id_userblog = ?");
                $requser->execute(array($_SESSION['id_userblog']));
                $user=$requser->fetch();

                if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
                {
                    $newpseudo = htmlspecialchars($_POST['newpseudo']);
                    $insertpseudo = $db->prepare("UPDATE userblog SET pseudo = ? WHERE id_userblog = ? " );
                    $insertpseudo->execute(array($newpseudo, $_SESSION['id_userblog']));
                    header('location:index.php?ctrl=secure&action=displayprofil&id=');
                    
                }

                if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
                {
                    $newmail = htmlspecialchars($_POST['newmail']);
                    $insertmail = $db->prepare("UPDATE userblog SET email = ? WHERE id_userblog = ? " );
                    $insertmail->execute(array($newmail, $_SESSION['id_userblog']));
                    header('location:index.php?ctrl=secure&action=displayprofil&id=');
                }

                if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
                {
        
                    $newmdp1 = password_hash($_POST['newmdp1'],PASSWORD_DEFAULT);
                    $newmdp2 = password_hash($_POST['newmdp2'],PASSWORD_DEFAULT);

                    if( $_POST['newmdp1'] == $_POST['newmdp2'])
                    {
                        $insertmdp = $db->prepare("UPDATE userblog SET mdp = ? WHERE id_userblog = ? " );
                        $insertmdp->execute(array($newmdp1, $_SESSION['id_userblog']));
                        header('location:index.php?ctrl=secure&action=displayprofil&id=');
                    }
                    else
                    {
                        Session ::addFlash("error", "Vos 2 mots de passe ne sont pas identiques");
                    }
        
                }
                // var_dump($_SESSION);die;
                return
                [
                    "view" => VIEW_DIR."modifProfilView.php",
                    "data" => $profil
                ];
            // }
            // else
            // {
            //     header("location : connectCreateView.php");
            // }
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

    
