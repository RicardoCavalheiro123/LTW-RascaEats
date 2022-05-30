<?php 

    function getMenu($db){
        $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetchAll();
    }

    function getImages($db){
        $stmt = $db->prepare('SELECT * FROM DishPhoto');
        $stmt->execute();
        return $stmt->fetchAll();
    }

?>