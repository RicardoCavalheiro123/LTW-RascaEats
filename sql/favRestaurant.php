<?php

    function setFavRestaurant($db){
        if(isset($_POST['favRestaurantSubmit'])){
            $clientId = $_POST['clientId'];
            $restaurantId = $_POST['restaurantId'];
            $stmt = $db->prepare('INSERT INTO FavRestaurant (clientId, restaurantId) VALUES (?, ?)');

            $stmt->execute(array($clientId, $restaurantId));

        }
    }

    function deleteFavRestaurant($db){
        if(isset($_POST['favRestaurantSubmit'])){
            $clientId = $_POST['clientId'];
            $restaurantId = $_POST['restaurantId'];
            $stmt = $db->prepare('DELETE FROM FavRestaurant WHERE clientId = ? AND restaurantId = ?');

            $stmt->execute(array($clientId,$restaurantId));
        }
    }

    function checkFavRestaurant($db){
        $stmt = $db->prepare('SELECT * FROM favRestaurant WHERE restaurantId = ? AND clientId = ?' );
        $stmt->execute(array($_GET['id'],$_SESSION['id']));

        $result = $stmt->fetchAll();

        if(count($result) > 0) return true;
    }

?>