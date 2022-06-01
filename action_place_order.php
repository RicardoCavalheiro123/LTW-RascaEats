<?php 
    declare(strict_types = 1);

    session_start();

    require_once('sql/connection.php');
    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    
    $requests = $_SESSION['cart'][$_GET['id']];

    $stmt = $db->prepare('INSERT INTO Request(clientId, state) VALUES (?, "Processing")');
    $stmt->execute(array($_SESSION['id'])); 

    $stmt = $db->prepare('SELECT last_insert_rowid()');
    $stmt->execute(); 
    $id = $stmt->fetch();

    foreach(array_keys($requests) as $request){ 
        $qt = $requests[$request];
        if($qt <= 0){
            continue;
        }
        unset($_SESSION['cart'][$_GET['id']][$request]);
        $stmt = $db->prepare('INSERT INTO CurrentRequest(dishId, requestId, quantidade) VALUES (?,?,?)');
        $stmt->execute(array($request, $id['last_insert_rowid()'], $qt)); 
    }

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>