
<?php 

    require_once(__DIR__. '/../sql/connection.php');
    require_once(__DIR__. '/../restaurant.class.php');
    require_once(__DIR__. '/../templates/restaurant.php');

    require_once(__DIR__. '/../templates/comments.php');
    require_once(__DIR__. '/../sql/comments.class.php');
    require_once(__DIR__. '/../sql/answers.class.php');

    require_once(__DIR__. '/../templates/common.php');

    require_once(__DIR__. '/../templates/dishes.php');
    require_once(__DIR__. '/../sql/dish.class.php');
    require_once(__DIR__. '/../sql/favRestaurant.php');
    require_once(__DIR__. '/../sql/favDish.php');

    require_once(__DIR__. '/../templates/cart.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = Restaurant::getRestaurant($db);
    if (!isset($_SESSION['id'])){
        header('Location: ../pages/login_register.php');
    }
    $stmt = $db->prepare('
        DELETE FROM Answer where commentId = ?
      ');
    
    $stmt->execute(array($_GET['id']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?>