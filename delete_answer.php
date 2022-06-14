
<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.class.php');
    require_once('templates/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.class.php');
    require_once('sql/answers.class.php');

    require_once('templates/common.php');

    require_once('templates/dishes.php');
    require_once('sql/dish.class.php');
    require_once('sql/favRestaurant.php');
    require_once('sql/favDish.php');

    require_once('cart.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = Restaurant::getRestaurant($db);
    if (!isset($_SESSION['id'])){
        header('Location: login_register.php');
    }
    $stmt = $db->prepare('
        DELETE FROM Answer where commentId = ?
      ');
    
    $stmt->execute(array($_GET['id']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>