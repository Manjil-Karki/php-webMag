<?php
    include $_SERVER['DOCUMENT_ROOT'].'./config/init.php';
    redirect('cms/index');



//Hypothetical data......
    $user = new user();
    $data1 = array(
        'username' => 'karki',
        'email' => 'manjilkarki2000@gamil.com',
        'session_token' => tokenize(),
        'role' => 'Admin'
    );
    $data2 = array(
        'username' => 'manjil',
        'email' => 'mankarki2000@gamil.com',
        'session_token' => tokenize(),
        'role' => 'Admin'
    );
    $data3 = array(
        'username' => 'manjilkarki',
        'email' => 'mkarki2000@gamil.com',
        'session_token' => tokenize(),
        'role' => 'Admin'
    );
    $data4 = array(
        'username' => 'karkimanjil',
        'email' => 'manjiljkarki2000@gamil.com',
        'session_token' => tokenize(),
        'role' => 'Admin'
    );
//Addition of data.....
    $user->addUser($data1);
    // $user->addUser($data2);
    // $user->addUser($data3);
    // $user->addUser($data4);

// get data from table on the basis of email and id
    // $datas = $user->getUserById(4);
    // $datass = $user->getUserByEmail('mkarki2000@gamil.com');
    // debugger($datas);
    // debugger($datass);

//deleting data    
    //$user->deleteDataByEmail('manjilkarki2000@gamil.com');

//update the data
   // $user->updateDataByEmail($data1, 'manjiljkarki2000@gamil.com');
    
    ?>