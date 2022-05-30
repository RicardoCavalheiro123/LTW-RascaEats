<?php


    function output_dishes($menu,$images){
        foreach($menu as $dish){ ?>
            <article class = "dish">
                <img src=<?php foreach($images as $image){
                    if($image['dishId'] == $dish['dishId']) echo $image['photo'];
                } ?>>
                <p class="dishName"><?php echo $dish['dishName'] ?></p>
                <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                <input class="quantity" type="number" value="1">
                <button class="buy">Adicionar ao carrinho</button></article> <?php
            }
    }

?>