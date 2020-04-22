<?php
    namespace App;

    class Session{

        /**
        *   ajoute un message en session, dans la catégorie $categ
        */
        public static function addFlash($categ, $msg){
            $_SESSION[$categ] = $msg;
        }

        /**
        *   renvoie un message de la catégorie $categ, s'il y en a !
        */
        public static function getFlash($categ){
            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

        /**
        *   met un user dans la session (pour le maintenir connecté)
        */
        public static function setUserBlog($userblog){
            $_SESSION["id_userblog"] = $userblog;
        }

        public static function getUserBlog(){
            return (isset($_SESSION['id_userblog'])) ?$_SESSION['id_userblog'] : false;
        }

        public static function authenticationRequired(){
            if(self::getUserBlog()){
                return true;
            }
            return false;
        }

        public static function isAdmin(){
            if(self::getUserBlog() && self::getUserBlog()->hasRole("ROLE_ADMIN")){
                return true;
            }
            return false;
        }
    }