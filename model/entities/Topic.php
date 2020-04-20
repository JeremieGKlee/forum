<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $content;
        private $topicDate;
        private $userblog;


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
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }
        
        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }

        /**
         * Get the value of topicdate
         */ 
        public function getTopicDate($format = null)
        {
                $format = ($format) ? $format : "d/m/Y à H:i:s";
                $formattedDate = $this->topicDate->format($format);
                return $formattedDate;
        }

        /**
         * Set the value of topicdate
         *
         * @return  self
         */ 
        public function setTopicDate($topicDate)
        {
                $this->topicDate = new \DateTime($topicDate);

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUserBlog()
        {
                return $this->userblog;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUserBlog($userblog)
        {
                $this->userblog = $userblog;

                return $this;
        }

        public function __toString(){

            return $this->title." ".$this->content." ".$this->topicDate;
        }

    }
