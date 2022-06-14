<?php 

    require_once('templates/common.php');
    require_once('templates/dishes.php');


?>


<?php 

    function output_favorites($db, $favRestaurants,$favDishes){
        $i = 0; ?>
        <div id = "all_favorites">
        <section id = "restaurantes">
            <h2>Restaurantes</h2>
            <?php if(!$favRestaurants){?>
                <span class = "bold"><p>Não selecionaste nenhum restaurante como favorito!</p></span>
            <?php
            }?>
            <?php foreach($favRestaurants as $restaurant){ 
                
                $rating = Restaurant::getRating($db,$restaurant['restaurantId']);?>
                

                <article>
                    <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="<?php echo $restaurant['photo']?>"alt="Restaurant photo" width="300px" height = "300px"></a>
                    <section id = "desc"><a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                    <p><?php echo $rating ?>/5.0 ☆</p>
                    <p><?php echo $restaurant['adress']?></p></section>
                </article>
                <?php $i += 1 ?>

            <?php } ?>

        </section>

        <section id = "pratos">
            <h2>Pratos</h2>
            <?php if(!$favDishes){?>
                <span class = "bold"><p>Não selecionaste nenhum prato como favorito!</p></span>
            <?php
            }?>
            <?php $i = 0 ?>
            
            <?php foreach($favDishes as $dish){ ?>

                <article >
                    <a href="restaurant.php?id=<?php echo $dish['restaurantId']?>"><img src="<?php echo $dish['photo']?>"alt="Dish photo" width="300px" height = "300px"></a>
                    <section id ="desc"><a href="restaurant.php?id=<?php echo $dish['restaurantId']?>"><p><?php echo $dish['dishName']?></p></a>
                    <p><?php echo $dish['category']?></p>
                    <p><?php echo $dish['price']?></p></section>
                </article>
                <?php $i+=1; ?>
            <?php } ?>
            

        </section>
        </div>
    

<?php    } ?>