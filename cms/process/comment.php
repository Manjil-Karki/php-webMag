<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $comment = new comment();
    if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $comment_id = (int)$_GET['id'];
            if ($comment_id) {
                $accept_act = substr(md5("Accept-Comment-".$comment_id.$_SESSION['token']), 5, 20);
                $reject_act = substr(md5("Reject-Comment-".$comment_id.$_SESSION['token']), 5, 20);

                if($accept_act == $_GET['act']){
                    $comment_info = $comment->getCommentById($comment_id);
                    if ($comment_info) {
                        $data = array(
                            'state' => 'Accepted'
                        );
                        $success = $comment->updateCommentById($data, $comment_id);
                        if ($success) {
                            redirect('../comment', 'success', 'Comment accepted successfully');
                        }else{
                            redirect('../comment', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../comment', 'error', 'Data already not available');
                    }

                }else if($reject_act == $_GET['act']){
                    $comment_info = $comment->getCommentById($comment_id);
                    if ($comment_info) {
                        $data = array(
                            'state' => 'Rejected'
                        );
                        $success = $comment->updateCommentById($data, $comment_id);
                        if ($success) {
                            redirect('../comment', 'success', 'Comment rejected successfully');
                        }else{
                            redirect('../comment', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../comment', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../comment', 'error', 'Invalid act key');
                }
            }else{
                redirect('../comment', 'error', 'is is invalid');
            }
        }else{
            redirect('../comment', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../comment', 'error', 'Unauthorized Access');
    }


?>