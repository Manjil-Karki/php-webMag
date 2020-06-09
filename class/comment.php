<?php
    class comment extends database{
        function __construct(){
            $this->table = 'comments';
            database :: __construct();
        }
        public function addComment($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getCommentById($comment_id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $comment_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }
    public function getAllComments($is_die = false){
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

    public function getAllWaitingComments($is_die = false){
        $args = array(
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'state' => 'Waiting'
                )                
            ),
            'order' => 'ASC'
        );
        return $this->getData($args, $is_die);
    }

    public function getAllAcceptedCommentsByBlog($blog_id, $is_die = false){
        $args = array(
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'state' => 'Accepted',
                    'blogid' => $blog_id,
                    'commentType' => 'comment'
                )                
            ),
            'order' => 'ASC'
        );
        return $this->getData($args, $is_die);
    }

    public function getAllAcceptedReplyByBlogOnComment($blog_id, $comment_id, $is_die = false){
        $args = array(
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'state' => 'Accepted',
                    'blogid' => $blog_id,
                    'commentType' => 'reply',
                    'commentid' => $comment_id

                )                
            ),
            'order' => 'ASC'
        );
        return $this->getData($args, $is_die);
    }

    public function updateCommentById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteCommentById($id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->deleteData($args, $is_die);
    }

    public function getNumberOfCommentsByBlog($blog_id, $is_die = false){
        $args = array(
            'fields' => ['COUNT(id) as total'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'state' => 'Accepted',
                    'blogid' => $blog_id
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

}


?>