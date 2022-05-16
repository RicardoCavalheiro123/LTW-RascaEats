<?php 
    function getRestaurantCategory($db, $category){
        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE category = :category');
        $stmt->execute([ 'category' => $category ]);
        return $stmt->fetchAll();
    }

    function getCategories($db){
        $stmt = $db->prepare('SELECT DISTINCT category FROM Restaurant');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getRestaurant($db){
        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantId = ?');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>