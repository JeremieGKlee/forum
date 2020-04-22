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
    
        // public function modifPost($id, $post) // pour modifier un commentaire
        // {
        //     $db = $this-> dbConnect();
        //     $posts = $db->prepare('UPDATE postblog SET post = :post WHERE id_postblog = :id_postblog');
        //     $affectedComment = $posts->execute(array('post' => $post, 'id_postblog' => $id));
            
        //     return $affectedComment;
        // }

        public function modifPost($post, $id) // pour modifier un commentaire
        {
            $sql = "UPDATE ".$this->tableName."
            SET post = :post
            WHERE id_postblog = :id_postblog
            ";
            return DAO::update($sql,
            [
                'post' => $post,
                'id_postblog' => $id
            ]
            );
        }
    
    
    }
