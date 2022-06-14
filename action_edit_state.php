<?php 
    declare(strict_types = 1);

    require_once('sql/connection.php');

    $db = getDatabaseConnection();

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    session_start();
    $state = $_POST['state'];
    $requestId = $_GET['id'];
    $stmt = $db->prepare('UPDATE Request SET state = ? WHERE requestId = ?');
    $stmt->execute(array($state , $requestId));
    
    header('Location: order_history.php');

?>