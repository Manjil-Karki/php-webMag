<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    debugger($_POST);
    $data = array();
    if($_POST){
        if(isset($_POST) && !empty($_POST)){
            $data['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            if($data['email']){
                if(isset($_POST['password']) && !empty($_POST['password'])){
                    $data['password'] = sha1($_POST['email'].$_POST['password']);
                    $user = new user();
                    $user_data = $user->getUserByEmail($data['email']);
                    debugger($user_data);
                    if (isset($user_data[0]->email) && !empty($user_data[0]->email)) {
                        if($user_data[0]->password == $data['password']){
                            if($user_data[0]->role == 'Admin'){
                                if($user_data[0]->status == 'Active'){
                                    $_SESSION['user_id'] = $user_data[0]->id;
                                    $_SESSION['user_name'] = $user_data[0]->username;
                                    $_SESSION['user_email'] = $user_data[0]->email;
                                    $_SESSION['user_role'] = $user_data[0]->role;
                                    $_SESSION['user_status'] = $user_data[0]->status;
                                    $token = tokenize();
                                    $_SESSION['token'] = $token;
                                    $data = array(
                                        'session_token' => $token
                                    );
                                    $user->updateDataByEmail($data, $_SESSION['user_email']);
                                    redirect('../index', 'success', 'Welcome to dashboard');
                                }else{
                                    redirect('../login', 'error', 'You are not a valid user');
                                }
                            }else{
                                redirect('../login', 'error', 'U cannot login here');
                            }
                        }else{
                            redirect('../login', 'error', 'Password donot match');
                        }
                    }else {
                        redirect('../login', 'error', 'Email doesnt exist');
                    }
                }else{
                    redirect('../login', 'error', 'Password cannot be empty');
                }
            }else{
                redirect('../login', 'error', 'Email is not valid');
            }
        }else{
            redirect('../login', 'error', 'Fields cannot be empty');
        }
    }else {
        redirect('../login', 'error', 'Unauthorized Access');
    }

?>