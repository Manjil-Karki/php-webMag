<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $category = new category();
    if ($_POST) {
        $data = array(
            'categoryname' => sanitize($_POST['categoryname']),
            'description' => htmlentities($_POST['description']),
            'added_by' => $_SESSION['user_id']
        );
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $act = 'updat';
            $category_id = (int)$_POST['id'];
        }else{
            $act = 'add';
            $category_id = false;
        }
        if ($category_id) {
            $category_info = $category -> getCategoryById($category_id);
            if ($category_info) {
                if ($_SESSION['user_id'] == $category_info[0]->added_by){
                    $success = $category -> updateCategoryById($data, $category_id);
                }
            }else{
                redirect('../category', 'error', 'Category not found');
            }
        }else{
            $success =  $category -> addCategory($data);
        }
       if ($success) {
           redirect('../category', 'success', 'Category '.$act.'ed successfully');
       } else {
           redirect('../category', 'error', 'category cannot be '.$act.'ed');
       }
       
    }else if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $category_id = (int)$_GET['id'];
            if ($category_id) {
                $act = substr(md5("Delete-Category-".$category_id.$_SESSION['token']), 5, 20);
                if($act == $_GET['act']){
                    $category_info = $category->getCategoryById($category_id);
                    if ($category_info) {
                        $data = array(
                            'status' => 'Passive'
                        );
                        $success = $category->updateCategoryById($data, $category_id);
                        if ($success) {
                            redirect('../category', 'success', 'Category deletd successfully');
                        }else{
                            redirect('../category', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../category', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../category', 'error', 'Invalid act key');
                }
            }else{
                redirect('../category', 'error', 'is is invalid');
            }
        }else{
            redirect('../category', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../category', 'error', 'Unauthorized Access');
    }


?>