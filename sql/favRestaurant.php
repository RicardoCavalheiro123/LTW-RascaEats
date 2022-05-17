<?php

    function setFavRestaurant($db){
        if(isset($_POST['favRestaurantSubmit'])){
            $clientId = $_POST['clientId'];
            $restaurantId = $_POST['restaurantId'];
            $stmt = $db->prepare('INSERT INTO FavRestaurant (clientId, restaurantId) VALUES (?, ?)');

            $stmt->execute(array($clientId, $restaurantId));

        }
    }

?>