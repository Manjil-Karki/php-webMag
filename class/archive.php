<?php
    class archive extends database{
        function __construct(){
            $this->table = 'archives';
            database :: __construct();
        }
        public function addArchive($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getArchiveById($archive_id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $archive_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }
    public function getAllArchives($is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )                
            ),
            'order' => 'ASC'
        );
        return $this->getData($args, $is_die);
    }

    public function updateArchiveById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteArchiveById($id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->deleteData($args, $is_die);
    }

}


?>