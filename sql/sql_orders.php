<?php 

    function get_orders($db){
        $stmt = $db->prepare('SELECT * FROM Request WHERE clientId = ? ORDER BY requestId DESC');
        $stmt->execute(array($_SESSION['id']));
        return $stmt->fetchAll();
    }

    function get_my_restaurant_orders($db){
        $stmt = $db->prepare('SELECT * FROM request JOIN currentrequest using(requestid) JOIN dish using(dishid) JOIN restaurant using(restaurantid) WHERE ownerid = ? ORDER BY requestId DESC');
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

    

?>