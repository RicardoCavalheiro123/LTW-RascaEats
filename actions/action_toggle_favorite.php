<?php 
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__. '/../sql/connection.php');
    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $clientId = $_POST['clientId'];
    $restaurantId = $_POST['restaurantId'];

    echo $restaurantId;

    $stmt = $db->prepare('SELECT * FROM FavRestaurant WHERE restaurantId = ? AND clientId = ?' );
    $stmt->execute(array($restaurantId, $clientId));

    $result = $stmt->fetch();

    
    if($result){
        $stmt = $db->prepare('DELETE FROM FavRestaurant WHERE clientId = ? AND restaurantId = ?');
        $stmt->execute(array($clientId,$restaurantId));
    }
    else{
        $stmt = $db->prepare('INSERT INTO FavRestaurant (clientId, restaurantId) VALUES (?, ?)');
        $stmt->execute(array($clientId, $restaurantId));
    }

?>