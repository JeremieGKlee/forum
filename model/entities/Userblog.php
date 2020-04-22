<?php
    namespace Model\Entities;

    use App\Entity;

    final class Userblog extends Entity{

        private $id;
        private $pseudo;
        private $role;
        private $email;
        private $userBlogDate;
        private $avatar;



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
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return ucfirst($this->pseudo);
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }
        
        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRoles($roles)
        {
            if($roles == null){
                $this->roles[] = "ROLE_USER";
            }
            else $this->roles = json_decode($roles);

            return $this;
        }

        public function hasRole($role)
        {
            return in_array($role, $this->roles);
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of userblogdate
         */ 
        public function getUserBlogDate($format = null)
        {
                $format = ($format) ? $format : "d/m/Y à H:i:s";
                $formattedDate = $this->userBlogDate->format($format);
                return $formattedDate;
        }

        /**
         * Set the value of userblogdate
         * @return  self
         */ 
        public function setUserBlogDate($userBlogDate)
        {
                $this->userBlogDate = new \DateTime($userBlogDate);

                return $this;
        }

        /**
         * Get the value of avatar
         */
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        public function __toString(){

            return $this->getPseudo();
        }

    }
