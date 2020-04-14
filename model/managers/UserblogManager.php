<?php
    namespace Model\Managers;
        
    use App\Manager;
    use App\DAO;
    use Model\Entities\Userblog;

    class UserblogManager extends Manager
    {

        protected $className = "Model\Entities\Userblog";
        protected $tableName = "userblog";

        public function __construct()
        {
            parent::connect();
        }

        public function nicknameAlreadyUsed($pseudo)
        {
            $sql = "SELECT COUNT(p.id_userblog)
                    FROM ".$this->tableName." p
                    WHERE p.pseudo = :pseudo";
            
            return DAO::select($sql, ['pseudo'=> $pseudo]);
        }

        public function mailAlreadyUsed($email)
        {
            $sql = "SELECT COUNT(e.id_userblog)
                    FROM ".$this->tableName." e
                    WHERE e.email = :email";
            
            return DAO::select($sql, ['email'=> $email]);
        }

        public function findByPseudo($pseudo){

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.pseudo = :pseudo
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $pseudo], false), 
                $this->className
            );
        }

        public function retrievePassword($pseudo){
            $sql = "SELECT p.mdp
                    FROM ".$this->tableName." p
                    WHERE p.pseudo = :pseudo
                    ";

            return DAO::select($sql, ['pseudo' => $pseudo]);
        }

        public function sessionopen($pseudo)
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." p
                    WHERE p.pseudo = :pseudo
                    ";
            return DAO::select($sql, ['pseudo' => $pseudo]);
        }


    }