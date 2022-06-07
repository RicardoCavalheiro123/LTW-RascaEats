<?php 
    declare(strict_types = 1);

    session_start();

    $id = $_GET['id'];
    $dishId = $_GET['dishId'];
    if(!isset($_SESSION['cart'][$id][$dishId])){
        $_SESSION['cart'][$id][$dishId] = 0;
    }
    $_SESSION['cart'][$id][$dishId]++;
    
    header('Location: '. $_SERVER['HTTP_REFERER']);

?>