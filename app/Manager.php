<?php
    namespace App;

    abstract class Manager{

        protected function connect(){
            DAO::connect();
        }

        // public function findAll(){

        //     $sql = "SELECT *
        //             FROM ".$this->tableName." a
        //             ";

        //     return $this->getMultipleResults(
        //         DAO::select($sql), 
        //         $this->className
        //     );
        // }

        public function findAll($order = null){

            $orderSQL = ($order != null) ?
                "ORDER BY a.".$order[0]. " " .$order[1] :
                "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderSQL;
            
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function findOneById($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }


        public function add($data){
            $keys = array_keys($data);
            // var_dump($keys);die;
            $values = array_values($data);
            // var_dump($values);;die;
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).")
                    VALUES
                    ('".implode("','",$values)."')";

            try
            {
                return DAO::insert($sql);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        public function delete($id){
            // var_dump($id);die;
            $sql = "DELETE
                    FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";
            // var_dump($this->tableName);die;
            return DAO::erase($sql, ['id' => $id]);
        }   
         
        public function change($data){
            $keys = array_keys($data);
            $values = array_values($data);
            $sql = "UPDATE ".$this->tableName."
                    (".implode(',', $keys).")
                    SET
                    ('".implode("','",$values)."')";

            return DAO::update($sql);
        }
        
        protected function getMultipleResults($rows, $class){

            $objects = [];

            if(!empty($rows)){
                foreach($rows as $row){
                    $objects[] = new $class($row);
                }
            }
            
            return $objects;
        }

        protected function getOneOrNullResult($row, $class){

            if($row != null){
                return new $class($row);
            }
            return false;
        }

        protected function getSingleScalarResult($row){

            if($row != null){
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }

    }