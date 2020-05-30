<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $blog = new blogs();
    if ($_POST) {
        $data = array(
            'title' => sanitize($_POST['title']),
            'content' => htmlentities($_POST['content']),
            'featured' => sanitize($_POST['featured']),
            'categoryid' => (int)$_POST['categoryid'],
            'added_by' => $_SESSION['user_id']
        );
        debugger($_POST);
        if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0){
            $success = uploadImage($_FILES['image'], 'blog');
            if($success){
                $data['image'] = $success;
                if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'blog/'.$_POST['old_img'])) {
					unlink(UPLOAD_PATH.'blog/'.$_POST['old_img']);
				}
            }else{
                redirect ('../addblog', 'error', 'Error while uploading image');
            }
        }

        if(isset($_POST['id']) && !empty($_POST['id'])){
            $act = 'updat';
            $blog_id = (int)$_POST['id'];
        }else{
            $act = 'add';
            $blog_id = false;
        }
        if ($blog_id) {
            $blog_info = $blog -> getBlogById($blog_id);
            if ($blog_info) {
                if ($_SESSION['user_id'] == $blog_info[0]->added_by){
                    $success = $blog -> updateblogById($data, $blog_id);
                }
            }else{
                redirect('../addblog', 'error', 'blog not found');
            }
        }else{
            $success =  $blog -> addBlog($data);
        }
       if ($success) {
           redirect('../list-blogs', 'success', 'blog '.$act.'ed successfully');
       } else {
           redirect('../addblog', 'error', 'blog cannot be '.$act.'ed');
       }
       
    }else if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $blog_id = (int)$_GET['id'];
            if ($blog_id) {
                $act = substr(md5("Delete-Blog-".$blog_id.$_SESSION['token']), 5, 20);
                if($act == $_GET['act']){
                    $blog_info = $blog->getBlogById($blog_id);
                    if ($blog_info) {
                        $data = array(
                            'status' => 'Passive'
                        );
                        $success = $blog->updateBlogById($data, $blog_id);
                        if ($success) {
                            redirect('../list-blog', 'success', 'blog deletd successfully');
                        }else{
                            redirect('../addblog', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../addblog', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../addblog', 'error', 'Invalid act key');
                }
            }else{
                redirect('../addblog', 'error', 'is is invalid');
            }
        }else{
            redirect('../addblog', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../addblog', 'error', 'Unauthorized Access');
    }


?>