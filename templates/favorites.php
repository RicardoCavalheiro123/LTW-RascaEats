<?php 

    require_once('templates/common.php');
    require_once('templates/dishes.php');


?>


<?php 

    function output_favorites($db, $favRestaurants,$favDishes){ ?>
        <section id = "restaurantes">
            <h2>Restaurantes</h2>
            <?php foreach($favRestaurants as $restaurant){ 

                $rating = Restaurant::getRating($db,$restaurant['restaurantId']);?>
                

                <article>
                    <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="<?php echo $restaurant['photo']?>"alt="Restaurant photo" width="300px" height = "300px"></a>
                    <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                    <p><?php echo $rating ?>/5.0 ☆</p>
                    <p><?php echo $restaurant['adress']?></p>
                </article>

            <?php } ?>
        </section>

        <section id = "pratos">
            <h2>Pratos</h2>

            <?php foreach($favDishes as $dish){ ?>

                <article>
                    <a href="restaurant.php?id=<?php echo $dish['restaurantId']?>"><img src="<?php echo $dish['photo']?>"alt="Dish photo" width="300px" height = "300px"></a>
                    <a href="restaurant.php?id=<?php echo $dish['restaurantId']?>"><p><?php echo $dish['dishName']?></p></a>
                    <p><?php echo $dish['category']?></p>
                    <p><?php echo $dish['price']?></p>
                </article>

            <?php } ?>
        </section>

<?php    } ?>