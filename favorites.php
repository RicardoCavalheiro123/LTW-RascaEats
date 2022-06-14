<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: frontPage.php');
    }
    require_once('sql/connection.php');
    require_once('templates/common.php');
    require_once('templates/favorites.php');

    require_once('sql/restaurant.php');
    require_once('sql/dish.php');

    $db = getDatabaseConnection();

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $favRestaurants = Restaurant::getFavorites($db,$_SESSION['id']);
    $favDishes = Dish::getFavorites($db,$_SESSION['id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/comments.css">
    <link rel="stylesheet" href="css/dishes.css">
    <link rel="stylesheet" href="css/orders.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Restaurante</title>
</head>
<body>
<?php output_header_wo_search($db);
output_favorites($db,$favRestaurants,$favDishes);
output_footer();
?>

</body>
</html>