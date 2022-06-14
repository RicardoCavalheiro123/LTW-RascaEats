<?php

    function output_dishes($menu,$db){
        foreach($menu as $dish){ ?>
            <article class = "dish">
                <img src= <?php echo $dish['photo']?>>
                <section>
                    <p class="dishName"><?php echo $dish['dishName'] ?></p>
                    <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                    <p class = "dishCategory"><?php echo $dish['category'] ?></p>
                    <a href="actions/action_add_to_cart.php?id=<?php echo $_GET['id'] ?>&dishId=<?php echo $dish['dishId']?>">Adicionar ao carrinho</a>
                    
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