<?php
    class link extends database{
        function __construct(){
            $this->table = 'links';
            database :: __construct();
        }
        public function addLink($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getLinkById($link_id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $link_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }
    public function getAllLinks($is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function updateLinkById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteLinkById($id, $is_die = false){
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