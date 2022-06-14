<?php 

    require_once('templates/common.php');
    require_once('templates/dishes.php');


?>


<?php 

    function output_favorites($db, $favRestaurants,$favDishes){ ?>
        
        <h2>Restaurantes</h2>
        <?php foreach($favRestaurants as $restaurant){ 

            $rating = Restaurant::getRating($db,$restaurant['restaurantId']); ?>

            <article>
                <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="<?php echo $restaurant['photo']?>"alt="Restaurant photo" width="300px" height = "300px"></a>
                <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                <p><?php echo $rating ?>/5.0 ☆</p>
                <p><?php echo $restaurant['adress']?></p>
            </article>

        <?php } ?>

        <h2>Pratos</h2>

        <?php output_dishes($favDishes, $db);


    } ?>