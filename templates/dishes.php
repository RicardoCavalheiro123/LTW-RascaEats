<?php

    function output_dishes($menu){
        foreach($menu as $dish){ ?>
            <article class = "dish">
                <p class="dishId"><?php echo $dish['dishId'] ?></p>
                <p class="dishName"><?php echo $dish['dishName'] ?></p>
                <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                <input class="quantity" type="number" value="1">
                <button class="buy">Adicionar ao carrinho</button></article> <?php
            }
    }

?>