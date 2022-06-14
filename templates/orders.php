<?php function output_orders($db){
        $orders = get_orders($db);
        if(!$orders){?>
        
        <span class = "bold"><p>You have no orders yet!</p></span>

        <?php
            
        }
        else{
        ?>
        <div id = "orders_dish"> <?php
        foreach($orders as $order){
            $total = 0.0;
            $current_request = get_current_request($db, $order['requestId']);
            $restaurantName = get_restaurantName($db, $current_request[0]['dishId'])['restaurantName'];
             ?> 
            <article id = "order">
                <img src="<?=get_restaurantPhoto($db, $current_request[0]['dishId'])['photo']?>">
                
                <article id = "description">
                <p><?=$restaurantName?></p>
                <?php 
            foreach($current_request as $dish){  
                $d = get_dish($db, $dish['dishId']);
                $total += $d['price'] * $dish['quantidade']; ?>
                    <div id="dish">
                    <p> <?=$dish['quantidade']?> </p>
                    <p><?=$d['dishName']?></p>
                    <p><?=$d['price'] * $dish['quantidade']?></p> </div>
                
            
<?php       }  ?> <p>Total: <?=$total?></p> 
                  <p><?=$order['state']?></p></article>
            
            </article>  <?php
        }
        ?>
        </div>
        <?php
        }
    }

    function output_order_history($db){

        $orders = get_my_restaurant_orders($db);
        ?>
        <div id = "orders_dish"> <?php
        foreach($orders as $order){
            $total = 0.0;
            $current_request = get_current_request($db, $order['requestId']);
            $restaurantName = get_restaurantName($db, $current_request[0]['dishId'])['restaurantName'];?>

            <article id = "order">

                <img src="<?=get_restaurantPhoto($db, $current_request[0]['dishId'])['photo']?>">
                
                <article id = "description">
                <p><?=$restaurantName?></p>
                <?php 
            foreach($current_request as $dish){  
                $d = get_dish($db, $dish['dishId']);
                $total += $d['price'] * $dish['quantidade']; ?>
                    <div id="dish">
                    <p> <?=$dish['quantidade']?> </p>
                    <p><?=$d['dishName']?></p>
                    <p><?=$d['price'] * $dish['quantidade']?></p> </div>
                
            
            <?php }  ?> <p>Total: <?=$total?></p> 
                  <p><?=$order['state']?></p></article>

                <form action="action_edit_state.php?id=<?php echo $order['requestId'];?>" method="post" class="logout">
                    <select id="state" name = "state" class = "input-field">
                        <option value="Em Preparação">Em Preparação</option>
                        <option value="Pronto">Pronto</option>
                        <option value="Entregue">Entregue</option>
                    </select>

                    <button class="button-3" name = "editstate" id = "editstate" role="button">Save</button>

                </form>
            
            </article> <?php
        }
        ?>
        </div> 
        <?php
    }

?>