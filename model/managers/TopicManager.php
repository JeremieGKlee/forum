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

        // public function findAll(){
        //     return parent::findAll();
        // }

        // public function findOneById($id){
        //     return parent::findOneById($id);
        // }
    
    }