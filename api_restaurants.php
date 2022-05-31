<?php
    declare(strict_types = 1);

    session_start();

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');


    $db = getDatabaseConnection();

    $restaurants = Restaurant::searchRestaurants($db, $_GET['search'],8);

    echo json_encode($restaurants);
?>

