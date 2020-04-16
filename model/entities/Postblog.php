<?php
    namespace Model\Entities;

    use App\Entity;

    final class Postblog extends Entity{

        private $id;
        private $post;
        private $postDate;
        private $userblog;
        private $topic;
        private $datemodif;


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
         * Get the value of post
         */ 
        public function getPost()
        {
                return $this->post;
        }

        /**
         * Set the value of post
         *
         * @return  self
         */ 
        public function setPost($post)
        {
                $this->post = $post;

                return $this;
        }
        
        /**
         * Get the value of postDate
         */ 
        public function getPostDate()
        {
                return $this->postDate;
        }

        /**
         * Set the value of postDate
         *
         * @return  self
         */ 
        public function setPostDate($postDate)
        {
                $this->postDate = $postDate;

                return $this;
        }

        /**
         * Get the value of postDate
         */ 
        public function getUserBlog()
        {
                return $this->userblog;
        }

        /**
         * Set the value of postDate
         *
         * @return  self
         */ 
        public function setUserBlog($userblog)
        {
                $this->userblog = $userblog;

                return $this;
        }

        /**
         * Get the value of postDate
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of postDate
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }

         /**
         * Get the value of postDate
         */ 
        public function getDateModif()
        {
                return $this->datemodif;
        }

        /**
         * Set the value of postDate
         *
         * @return  self
         */ 
        public function setDateModif($datemodif)
        {
                $this->datemodif = $datemodif;

                return $this;
        }

        // public function __toString(){

        //     return $this->nom; ====>exemple
        //     return $this->immat." - ".$this->marque->getNom()." ".$this->modele;  ===> exemple
        // }

    }
