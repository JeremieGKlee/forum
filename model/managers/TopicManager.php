<?php
    namespace Model\Managers;
        
    use App\Manager;
    use App\DAO;
    use Model\Entities\Topic;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }

        public function close($idtopic, $closeNumber)
        {
            $sql = "UPDATE topic SET closed = :closenumber WHERE id_topic = :id";

            return DAO::update($sql, [ 'closenumber' => $closeNumber, 'id' => $idtopic]);
        }

        public function isClosed($idtopic)
        {
            $sql = "SELECT closed FROM topic WHERE id_topic = :id";

            return $this-> getSingleScalarResult(
            DAO::select($sql, ['id' => $idtopic], false)
            ); 
        }

        // public function findAll(){
        //     return parent::findAll();
        // }

        // public function findOneById($id){
        //     return parent::findOneById($id);
        // }
    
    }