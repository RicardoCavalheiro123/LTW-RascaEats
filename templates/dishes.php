<?php

    function output_dishes($menu,$images, $db){
        foreach($menu as $dish){ ?>
            <article class = "dish">
                <img src=<?php foreach($images as $image){
                    if($image['dishId'] == $dish['dishId']) echo $image['photo'];
                } ?>>
                <section>
                    <p class="dishName"><?php echo $dish['dishName'] ?></p>
                    <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                    <a href="action_add_to_cart.php?id=<?php echo $_GET['id'] ?>&dishId=<?php echo $dish['dishId']?>">Adicionar ao carrinho</a>
                    
                    <?php if(isset($_SESSION['id'])){ ?>
                        <span class="favDish">
                            <button type='submit' id= <?=$dish['dishId'] ?> name='favDishSubmit' <?php 
                                if (checkFavDish($db, $dish['dishId'])) echo "class = exists" 
                                ?> 
                                onclick="toggleFavDish(<?=$_SESSION['id']?>, <?=$dish['dishId']?>)">
                                <i class='fa-solid fa-heart'></i>
                            </button> 

                        </span>
                    <?php } ?>  
                </section>
            </article> <?php 
            }
    }

?>