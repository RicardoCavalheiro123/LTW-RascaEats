<?php

    function getComments($db){
        $stmt = $db->prepare('SELECT * FROM Comments JOIN Clients USING (clientID) JOIN Restaurants USING (restaurantId) WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetchAll();
    }

?>
