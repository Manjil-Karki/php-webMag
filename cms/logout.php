<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    $user = new user();
    $data = array(
        'session_token' => ""
    );
    $user->updateDataByEmail($data, $_SESSION['user_email']);

    if(isset($_COOKIE['_auth_user']) && !empty($_COOKIE['_auth_user'])){
        setcookie('_auth_user', $token, time()-455, '/');
    }
    session_unset();
    redirect('login')


?>