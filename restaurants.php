<?php

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    require_once('templates/common.php');
    require_once('templates/restaurant.php');
    require_once('templates/orders.php');

    session_start();

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    $ownerRestaurants = Restaurant::getRestaurantsOwned($_SESSION['id'], $db);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/orders.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <title>Os seus restaurantes</title>
</head>
    <body>

        <?php output_header_wo_search($db); ?>

        
        <button class = "button-3" id = "viewOrdersButton"><a href="order_history.php">Ver encomendas</a></button>
        <?php output_list_owned_restaurants($db,$ownerRestaurants); ?>
        <button class = "button-3" id = "addRestaurantButton"><a href="register_restaurant.php"> + Adicionar Restaurante</a></button>
        <?php output_footer(); ?>
    

    </body>
</html>
