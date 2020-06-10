<?php
    class subscriber extends database{
        function __construct(){
            $this->table = 'subscribers';
            database :: __construct();
        }
        public function addSubscriber($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getSubscriberById($subscriber_id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $subscriber_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function getSubscriberByEmail($subscriber_email, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'email' => $subscriber_email,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function getAllSubscribers($is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function updateSubscriberById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteSubscriberById($id, $is_die = false){
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