<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $comment = new comment();
    if ($_POST) {
        $act = 'Add';
        $data = array(
            'name' => $_POST['name'],
            'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
            'website' => sanitize($_POST['website']),
            'message' => sanitize(htmlentities($_POST['message'])),
            'blogid' => (int)$_POST['blogid']
        );
        if(isset($_POST['commentid']) && !empty($_POST['commentid'])){
            $comment_id = (int)$_POST['commentid'];
            $data['commentid'] = $comment_id;
            $data['commentType'] = 'reply';
        }else{
            $comment_id = false;
        }
        if ($comment_id) {
            $comment_info = $comment -> getCommentById($comment_id);
            if ($comment_info) {
                $success = $comment -> addComment($data);    
            }else{
                redirect('../blog-post?id='.$_POST['blogid'], 'error', 'Comment not found');
            }
        }else{
            $success =  $comment -> addComment($data);
        }
       if ($success) {
           redirect('../blog-post?id='.$_POST['blogid'], 'success', 'Comment '.$act.'ed successfully');
       } else {
           redirect('../blog-post?id='.$_POST['blogid'], 'error', 'comment cannot be '.$act.'ed');
       }
       
    }
    else{
        redirect('../blog-post?id='.$_POST['blogid'], 'error', 'Unauthorized Access');
    }


?>