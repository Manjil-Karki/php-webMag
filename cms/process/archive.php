<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $archive = new archive();
    if ($_POST) {
        $data = array(
            'date' => $_POST['date'],
            'added_by' => $_SESSION['user_id']
        );
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $act = 'updat';
            $archive_id = (int)$_POST['id'];
        }else{
            $act = 'add';
            $archive_id = false;
        }
        if ($archive_id) {
            $archive_info = $archive -> getArchiveById($archive_id);
            if ($archive_info) {
                if ($_SESSION['user_id'] == $archive_info[0]->added_by){
                    $success = $archive -> updateArchiveById($data, $archive_id);
                }
            }else{
                redirect('../archive', 'error', 'Archive not found');
            }
        }else{
            $success =  $archive -> addArchive($data);
        }
       if ($success) {
           redirect('../archive', 'success', 'Archive '.$act.'ed successfully');
       } else {
           redirect('../archive', 'error', 'archive cannot be '.$act.'ed');
       }
       
    }else if($_GET){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $archive_id = (int)$_GET['id'];
            if ($archive_id) {
                $act = substr(md5("Delete-Archive-".$archive_id.$_SESSION['token']), 5, 20);
                if($act == $_GET['act']){
                    $archive_info = $archive->getArchiveById($archive_id);
                    if ($archive_info) {
                        $data = array(
                            'status' => 'Passive'
                        );
                        $success = $archive->updateArchiveById($data, $archive_id);
                        if ($success) {
                            redirect('../archive', 'success', 'Archive deletd successfully');
                        }else{
                            redirect('../archive', 'error', 'Data cannot be deleted');
                        }
                    }else{
                        redirect('../archive', 'error', 'Data already not available');
                    }

                }else{
                    redirect('../archive', 'error', 'Invalid act key');
                }
            }else{
                redirect('../archive', 'error', 'is is invalid');
            }
        }else{
            redirect('../archive', 'error', 'Id is required');
        }
    }
    
    else{
        redirect('../archive', 'error', 'Unauthorized Access');
    }


?>