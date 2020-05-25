<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    include '../inc/checkLogin.php';

    if($_POST){
        if (isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])) {
            if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['newpassword']) && !empty($_POST['newpassword']) ) {
                if ($_POST['password'] == $_POST['newpassword']) {
                    $user = new user();
                    $user_info = $user->getUserByEmail($_SESSION['user_email']);
                    if($user_info){ 
                        $password = sha1($_SESSION['user_email'].$_POST['password']);
                        if($user_info[0]->password == $password){
                            $data = array(
                                'password' => sha1($user_info[0]->email.$_post['password'])
                            );
                            $success = $user->updateDataByEmail($data, $user_info[0]->email);
                            if ($success){
                                redirect('../password-change', 'success', 'Password changes successfully');
                            }else{
                                redirect('../password-change', 'error', 'Error while changing password');
                            }
                        }else{
                            redirect('../password-change', 'error', 'Old password is not correct');
                        }
                    }else{
                        redirect('../logout');
                    }
                }else{
                    redirect('../password-change', 'error', 'Password didnt matched');
                }
            }else{
                redirect('../password-change', 'error', 'Both password field is required');
            }
        }else{
            redirect('../password-change', 'error', 'Old password required');
        }
    }else{
        redirect('../password-change', 'error', 'Unauthorised Access');
    }



?>