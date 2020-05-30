<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $ad = new ad();
    if ($_POST) {
        $data = array(
            'title' => $_POST['title'],
            'url' => filter_var($_POST['url'], FILTER_SANITIZE_URL),
            'type' => $_POST['type'],
            'added_by' => $_SESSION['user_id']
        );

        if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0){
            $success = uploadImage($_FILES['image'], 'ad');
            if($success){
                $data['image'] = $success;
                if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'ad/'.$_POST['old_img'])) {
					unlink(UPLOAD_PATH.'ad/'.$_POST['old_img']);
				}
            }else{
                redirect ('../ads', 'error', 'Error while uploading image');
            }
        }
        
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $act = 'updat';
            $ad_id = (int)$_POST['id'];
        }else{
            $act = 'add';
            $ad_id = false;
        }
        if ($ad_id) {
            $ad_info = $ad -> getAdById($ad_id);
            if ($ad_info) {
                if ($_SESSION['user_id'] == $ad_info[0]->added_by){
                    $success = $ad -> updateAdById($data, $ad_id);
                }
            }else{
                redirect('../ads', 'error', 'Ad not found');
            }
        }else{
            
            $success =  $ad -> addAd($data);
        }
       if ($success) {
           redirect('../ads', 'success', 'Ad '.$act.'ed successfully');
       } else {
           redirect('../ads', 'error', 'Ad cannot be '.$act.'ed');
       }
       
    }else if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $ad_id = (int)$_GET['id'];
            if ($ad_id) {
                $act = substr(md5("Delete-Ad-".$ad_id.$_SESSION['token']), 5, 20);
                if($act == $_GET['act']){
                    $ad_info = $ad->getAdById($ad_id);
                    if ($ad_info) {
                        $data = array(
                            'status' => 'Passive'
                        );
                        $success = $ad->updateAdById($data, $ad_id);
                        if ($success) {
                            redirect('../ads', 'success', 'Ad deletd successfully');
                        }else{
                            redirect('../ads', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../ads', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../ads', 'error', 'Invalid act key');
                }
            }else{
                redirect('../ads', 'error', 'is is invalid');
            }
        }else{
            redirect('../ads', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../ads', 'error', 'Unauthorized Access');
    }


?>