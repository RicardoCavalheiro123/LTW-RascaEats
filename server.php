<?php

    session_start();
    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    $username = "";
    $email = "";

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    //Register
    
    $username = user($db, $_POST['username']);
    $email = user($db, $_POST['email']);
    $password = user($db, $_POST['password']);
>