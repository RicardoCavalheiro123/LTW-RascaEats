<?php 

    require_once(__DIR__. '/../sql/connection.php');
    require_once(__DIR__. '/../templates/common.php');
    require_once(__DIR__. '/../templates/restaurant.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/restaurant.css">
    <link rel="stylesheet" href="../css/comments.css">
    <link rel="stylesheet" href="../css/dishes.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script> 
    <title><?=$restaurant->$name?></title>
</head>
    <body>
<?php 

    output_header($db); 
    output_restaurant_register($db);
    output_footer();
?>