<?php

    function getComments($db){
        $stmt = $db->prepare('SELECT * FROM Comments JOIN Client USING (clientID) WHERE restaurantId = ?');
        $stmt->execute(array($_GET['id']));
        return $stmt->fetchAll();
    }

    function setComments($db){
        if(isset($_POST['commentSubmit'])){
            $clientId = $_POST['clientId'];
            $restaurantId = $_POST['restaurantId'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];

            $stmt = $db->prepare('INSERT INTO Comments (clientId, restaurantId, comment, published) VALUES (?, ?, ?, ?)');

            $stmt->execute(array($clientId, $restaurantId, $comment, $date));

            echo "<meta http-equiv='refresh' content='0'>";

        }
    }

?>
