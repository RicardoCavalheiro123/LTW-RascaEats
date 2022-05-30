<?php
    declare(strict_types = 1);

    $db = getDatabaseConnection();

    $restaurants = Restaurants::searchRestaurants($db, $_GET['search'],8)
?>

