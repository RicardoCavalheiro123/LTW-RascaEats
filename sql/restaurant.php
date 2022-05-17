<?php 
    function getRestaurantCategory($db, $category){
        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE category = ? limit 3');
        $stmt->execute(array($category));
        return $stmt->fetchAll();
    }

    function getCategories($db){
        $stmt = $db->prepare('SELECT DISTINCT category FROM Restaurant ORDER BY category');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getRestaurant($db){
        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetch();
    }

    function getMenu($db){
        $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetchAll();
    }
?>