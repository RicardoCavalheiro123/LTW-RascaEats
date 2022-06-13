
<?php 

require_once('sql/connection.php');
require_once('sql/restaurant.php');
require_once('templates/restaurant.php');

require_once('templates/comments.php');
require_once('sql/comments.php');

require_once('templates/common.php');

require_once('templates/dishes.php');
require_once('sql/dish.php');
require_once('sql/favRestaurant.php');
require_once('sql/favDish.php');

require_once('cart.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = Restaurant::getRestaurant($db);
    if (isset($_SESSION['id'])){

        $isOwner = Restaurant::isRestaurantOwner($restaurant,$_SESSION['id']);
        if(!$isOwner){
            header("Location: restaurant.php?id=$restaurant->restaurantId");
        }
    }
    
 
    $menu = Dish::getMenu($db);
    $dishImages = Dish::getDishImages($db, $restaurant->restaurantId);
    $restaurantImages = Restaurant::getRestaurantImage($db, $restaurant->restaurantId);
    $restaurantImage = $restaurantImages['photo'];

    $comments = Comments::getComments($db);
    $ratings = Comments::getRatings($db);

    $name = 'restaurantName';
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
    <link rel="stylesheet" href="css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="cart.js" defer></script>
    <script src="search.js" defer></script>
    <script src="favRestaurant.js" defer></script>
    <script src="favDish.js" defer></script>    
    <title><?=$restaurant->$name?></title>
</head>
<body>
<?php 

    output_header($db);

    output_restaurant_owner($restaurant, $db, $ratings, $restaurantImage);

    output_cart();

?>
    
    <section id = "dishes">

        <?php output_dishes($menu,$db)?>
        
    </section>
    <form action="editRestaurant.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="editRestaurantDish">
            <button class="button-4" name= "editDish" id = "editDish" role="button">Edit Dishes</button>
    </form>
    
    <section id = "reviews">
        <?php output_comments_answers($comments)?>


    </section>
    <?php output_footer()?>

    </body>
</html>