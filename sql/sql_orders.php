<?php 

    function get_orders($db){
        $stmt = $db->prepare('SELECT * FROM Request WHERE clientId = ? ORDER BY requestId DESC');
        $stmt->execute(array($_SESSION['id']));
        return $stmt->fetchAll();
    }

    function get_current_request($db, $requestId){
        $stmt = $db->prepare('SELECT * FROM CurrentRequest WHERE requestId = ?');
        $stmt->execute(array($requestId));
        return $stmt->fetchAll();
    }

    function get_dish($db, $dishId){
        $stmt = $db->prepare('SELECT * FROM Dish WHERE dishId = ?');
        $stmt->execute(array($dishId));
        return $stmt->fetch();
    }

    function get_restaurantName($db, $dishId){
        $stmt = $db->prepare('SELECT restaurantName FROM Restaurant JOIN Dish using(restaurantId) WHERE dishId = ?');
        $stmt->execute(array($dishId));
        return $stmt->fetch();
    }

    function output_orders($db){
        $orders = get_orders($db);
        foreach($orders as $order){
            $total = 0.0;
            $current_request = get_current_request($db, $order['requestId']);
            $restaurantName = get_restaurantName($db, $current_request[0]['dishId'])['restaurantName'];
             ?> 
            <article id = "order">
                <img src="https://picsum.photos/200/200?<?=$restaurantName?>">
                <!-- <p>Número do pedido: //$order['requestId']</p> -->
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
            
            </article> <?php
        }
    }

?>