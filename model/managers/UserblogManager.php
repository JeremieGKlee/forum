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

            return $this->getSingleScalarResult(
                DAO::select($sql, ['pseudo'=> $pseudo],false)
            );
        }

        public function mailAlreadyUsed($email)
        {
            $sql = "SELECT COUNT(e.id_userblog)
                    FROM ".$this->tableName." e
                    WHERE e.email = :email";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['email'=> $email], false)
            );
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

            return $this->getSingleScalarResult(
                DAO::select($sql, ['pseudo' => $pseudo], false)
            );
        }

        public function sessionopen($pseudo)
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." p
                    WHERE p.pseudo = :pseudo
                    ";
            return DAO::select($sql, ['pseudo' => $pseudo],false);
        }

        public function changePseudo($newpseudo,$id)
        {
            $sql = "UPDATE ".$this->tableName."
                    SET pseudo = :pseudo
                    WHERE id_userblog = :id_userblog
                    ";
            return DAO::update($sql,
            [
                'pseudo' => $newpseudo,
                'id_userblog' => $id
            ]
            );
        }

        public function changeMail($newmail,$id)
        {
            $sql = "UPDATE ".$this->tableName."
                    SET email = :email
                    WHERE id_userblog = :id_userblog
                    ";
            return DAO::update($sql,
            [
                'email' => $newmail,
                'id_userblog' => $id
            ]
            );
        }

        public function changeMdp($newmdp1,$id)
        {
            $sql = "UPDATE ".$this->tableName."
                    SET mdp = :mdp
                    WHERE id_userblog = :id_userblog
                    ";
            return DAO::update($sql,
            [
                'mdp' => $newmdp1,
                'id_userblog' => $id
            ]
            );
        }

        public function changeAvatar($avatar,$id)
        {
            $sql = "UPDATE ".$this->tableName."
                    SET avatar = :avatar
                    WHERE id_userblog = :id_userblog
                    ";
            return DAO::update($sql,
            [
                'avatar' => $avatar,
                'id_userblog' => $id
            ]
            );
        }

        public function userProfil($id)
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName."
                    WHERE id_userblog = :id_userblog
                    ";
            return DAO::select($sql, ['id_userblog' => $id],false);
        }



    }