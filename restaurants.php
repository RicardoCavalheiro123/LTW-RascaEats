<?php

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    require_once('templates/common.php');
    require_once('templates/restaurant.php');

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <title><?=$restaurant->$name?></title>
</head>
    <body>

        <?php output_header($db); ?>

            <?php foreach($ownerRestaurants as $restaurant){ ?>

                <article>
                    <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="https://picsum.photos/300/300?<?php echo $restaurant['restaurantName']?>" alt="Restaurant photo"></a>
                    <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                    <p><?php echo $restaurant['rating']?>/5.0 ☆</p>
                    <p><?php echo $restaurant['adress']?></p>
                </article>

            <?php } ?>

        
        <?php output_footer(); ?>
    

    </body>
</html>
