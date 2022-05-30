<?php
    declare(strict_types = 1);

    session_start();

    require_once('database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Name LIKE ? LIMIT 8');
    $stmt->execute(array($search . '%'));

    $restaurants = $stmt->fetchAll();

    json_encode($restaurants);
?>