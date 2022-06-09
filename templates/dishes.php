<?php


    function output_dishes($menu,$images){
        foreach($menu as $dish){ ?>
            <article class = "dish">
                <img src=<?php foreach($images as $image){
                    if($image['dishId'] == $dish['dishId']) echo $image['photo'];
                } ?>>
                <section>
                    <p class="dishName"><?php echo $dish['dishName'] ?></p>
                    <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                    <a href="action_add_to_cart.php?id=<?php echo $_GET['id'] ?>&dishId=<?php echo $dish['dishId']?>">Adicionar ao carrinho</a> 
                </section>
            </article> <?php 
            }
    }

?>