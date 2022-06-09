<?php 

    function get_orders($db){
        $stmt = $db->prepare('SELECT * FROM Request WHERE clientId = ?');
        $stmt->execute(array($_SESSION['id']));
        return $stmt->fetchAll();
    }

    function get_current_request($db, $requestId){
        $stmt = $db->prepare('SELECT * FROM CurrentRequest WHERE requestId = ?');
        $stmt->execute(array($requestId));
        return $stmt->fetchAll();
    }

    function output_orders($db){
        $orders = get_orders($db);
        foreach($orders as $order){
            $current_request = get_current_request($db, $order['requestId']); ?> 
            <article id = "order"> <?php 
            foreach($current_request as $dish){  ?>
                <p>Dish Id: <?=$dish['dishId']?></p>
                <p>Quantidade: <?=$dish['quantidade']?></p>
            
<?php       } ?>
            </article> <?php
        }
    }

?>