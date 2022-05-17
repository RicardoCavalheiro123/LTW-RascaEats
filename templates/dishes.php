<?php

    function output_dishes($menu){
        foreach($menu as $dish){ ?>
            <article>
                <p class="dishName"><?php echo $dish['dishName'] ?></p>
                <p class = "dishPrice"><?php echo $dish['price'] ?></p>
                <input class="quantity" type="number" value="0">
                <button class="buy">Adicionar ao carrinho</button></article> <?php
            }
    }

?>