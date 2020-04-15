<?php
    namespace Model\Managers;
        
    use App\Manager;
    use App\DAO;
    use Model\Entities\Postblog;

    class PostblogManager extends Manager{

        protected $className = "Model\Entities\Postblog";
        protected $tableName = "postblog";

        public function __construct(){
            parent::connect();
        }

        /*public function findAll(){
            return parent::findAll();
        }

        public function findOneById($id){
            return parent::findOneById($id);
        }*/
    
        public function findByTopic($idtopic){
            $sql = "SELECT *
                    FROM ".$this->tableName." p WHERE p.topic_id = :id
                    ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $idtopic]), 
                $this->className
            );
        }
    
    
    
    
    }
