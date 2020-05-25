<?php
    $user = new user();
    if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
        $user_info = $user->getUserBySessionToken($_SESSION['token']);
        if(!isset($user_info[0]->session_token) || empty($user_info[0]->session_token)){
            redirect('logout');
        }else{
            if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == 'login'){
                redirect('index', 'success', 'You are already loged in');
            }
        }
    }else{


        if (isset($_COOKIE['_auth_user']) && !empty($_COOKIE['_auth_user'])) {
            $token = $_COOKIE['_auth_user'];
            $user_info = $user->getUserBySessionToken($token);
            if (isset($user_info[0]->session_token) && !empty($user_info[0]->session_token)){
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
                setcookie('_auth_user', $token, time()+(86400*7));
                if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == 'login'){
                    redirect('index', 'success', 'You are already loged in');
                }
            }else{
                setcookie('_auth_user', '', time()-345, '/');
                if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)!='login'){
                    redirect('login', 'error', 'You must login first');
                }
            }
        }else if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)!='login'){
            redirect('login', 'error', 'You must login first');
        }
    }
?>