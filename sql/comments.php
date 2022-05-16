<?php

    function getComments($db){
        $stmt = $db->prepare('SELECT * FROM Comments WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetchAll();
    }

?>
