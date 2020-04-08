<?php
    namespace Model\Managers;
        
    use App\Manager;
    use App\DAO;
    use Model\Entities\Userblog;

    class UserblogManager extends Manager{

        protected $className = "Model\Entities\Userblog";
        protected $tableName = "userblog";

        public function __construct(){
            parent::connect();
        }

        /*public function findAll(){
            return parent::findAll();
        }

        public function findOneById($id){
            return parent::findOneById($id);
        }*/
    }