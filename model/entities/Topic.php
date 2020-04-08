<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $content;
        private $topicDate;
        private $user;


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
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }
        
        /**
         * Get the value of origine
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }

        /**
         * Get the value of origine
         */ 
        public function getTopicDate()
        {
                return $this->topicDate;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setTopicDate($topicDate)
        {
                $this->topicDate = $topicDate;

                return $this;
        }

        /**
         * Get the value of origine
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of origine
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        // public function __toString(){

        //     return $this->nom;
        // }

    }