<?php 
    declare(strict_types = 1);

    session_start();

    require_once('sql/connection.php');
    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $clientId = $_POST['clientId'];
    $dishId = $_POST['dishId'];

    echo $dishId;

    $stmt = $db->prepare('SELECT * FROM FavDish WHERE clientId = ? AND dishId = ?' );
    $stmt->execute(array($clientId, $dishId));

    $result = $stmt->fetch();

    
    if($result){
        $stmt = $db->prepare('DELETE FROM FavDish WHERE clientId = ? AND dishId = ?');
        $stmt->execute(array($clientId,$dishId));
    }
    else{
        $stmt = $db->prepare('INSERT INTO FavDish (clientId, dishId) VALUES (?, ?)');
        $stmt->execute(array($clientId, $dishId));
    }

?>