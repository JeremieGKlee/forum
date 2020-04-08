<?php
    namespace Model\Entities;

    use App\Entity;

    final class Userblog extends Entity{

        private $id;
        private $pseudo;
        private $adminBlog;
        private $email;
        private $userBlogDate;



        public function __construct($data){         
            $this->hydrate($data);        
        }

        /** 
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        protected function setId($id){

            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of nom
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }
        
        /**
         * Get the value of origine
         */ 
        public function getAdminBlog()
        {
                return $this->adminBlog;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setAdminBlog($adminBlog)
        {
                $this->adminBlog = $adminBlog;

                return $this;
        }

        /**
         * Get the value of origine
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of origine
         */ 
        public function getUserBlogDate()
        {
                return $this->userBlogDate;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setUserBlogDate($userBlogDate)
        {
                $this->userBlogDate = $userBlogDate;

                return $this;
        }

        // public function __toString(){

        //     return $this->nom;
        // }

    }
