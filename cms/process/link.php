<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $link = new link();
    if ($_POST) {
        $data = array(
            'name' => $_POST['name'],
            'url' => filter_var($_POST['url'], FILTER_SANITIZE_URL),
            'added_by' => $_SESSION['user_id']
        );
        
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $act = 'updat';
            $link_id = (int)$_POST['id'];
        }else{
            $act = 'add';
            $link_id = false;
        }
        if ($link_id) {
            $link_info = $link -> getLinkById($link_id);
            if ($link_info) {
                if ($_SESSION['user_id'] == $link_info[0]->added_by){
                    $success = $link -> updateLinkById($data, $link_id);
                }
            }else{
                redirect('../link', 'error', 'Link not found');
            }
        }else{
            
            $success =  $link -> addLink($data);
        }
       if ($success) {
           redirect('../link', 'success', 'Link '.$act.'ed successfully');
       } else {
           redirect('../link', 'error', 'Link cannot be '.$act.'ed');
       }
       
    }else if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $link_id = (int)$_GET['id'];
            if ($link_id) {
                $act = substr(md5("Delete-Link-".$link_id.$_SESSION['token']), 5, 20);
                if($act == $_GET['act']){
                    $link_info = $link->getLinkById($link_id);
                    if ($link_info) {
                        $data = array(
                            'status' => 'Passive'
                        );
                        $success = $link->updateLinkById($data, $link_id);
                        if ($success) {
                            redirect('../link', 'success', 'Link deletd successfully');
                        }else{
                            redirect('../link', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../link', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../link', 'error', 'Invalid act key');
                }
            }else{
                redirect('../link', 'error', 'is is invalid');
            }
        }else{
            redirect('../link', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../link', 'error', 'Unauthorized Access');
    }


?>