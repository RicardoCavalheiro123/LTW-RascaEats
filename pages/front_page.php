<?php 
    declare(strict_types = 1);
    session_start();
    require_once(__DIR__. '/../sql/connection.php');
    require_once(__DIR__. '/../sql/restaurant.class.php');
    require_once(__DIR__. '/../templates/common.php');
    require_once(__DIR__. '/../templates/restaurant.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = Restaurant::getCategories($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="../javascript/search.js" defer></script>
    <title>Rasca Eats</title>
</head>
<body>
    <?php output_header($db); 
    
    output_list_restaurants($categories, $db);

    output_footer();  ?>

    </body>
</html>