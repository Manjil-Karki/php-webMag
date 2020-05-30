<?php
    class ad extends database{
        function __construct(){
            $this->table = 'ads';
            database :: __construct();
        }
        public function addAd($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getAdById($ad_id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $ad_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }
    public function getAllAds($is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function updateAdById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteAdById($id, $is_die = false){
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