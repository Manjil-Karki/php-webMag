<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    debugger($_POST);
    if ($_POST) {
        $email = $_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $data = array(
                'email' => filter_var($email, FILTER_VALIDATE_EMAIL)            
            );
            $subscriber = new subscriber();
            $subscriber_info = $subscriber->getSubscriberByEmail($email);
            if($subscriber_info[0]->email == $email){
                redirect('../index');
            }
            $success = $subscriber->addSubscriber($data);
            if($success){
                redirect('../index');
            }    
        }else{
            
            redirect('../blank');
        }        
    }else{
        redirect('../blank');
    }
?>