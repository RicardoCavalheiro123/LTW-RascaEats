
<?php 

require_once(__DIR__. '/../sql/connection.php');
require_once(__DIR__. '/../sql/restaurant.class.php');
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
    if (isset($_SESSION['id'])){

        $isOwner = Restaurant::isRestaurantOwner($restaurant,$_SESSION['id']);
        if(!$isOwner){
            header("Location: ../pages/restaurant.php?id=$restaurant->restaurantId");
        }
    }
    
 
    $menu = Dish::getMenu($db);
    $dishImages = Dish::getDishImages($db, $restaurant->restaurantId);
    $restaurantImages = Restaurant::getRestaurantImage($db, $restaurant->restaurantId);
    $restaurantImage = $restaurantImages['photo'];

    $comments = Comments::getComments($db);
    $answers = Answers::getAnswers($db);

    $name = 'restaurantName';
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
    <script src="../javascript/cart.js" defer></script>
    <script src="../javascript/search.js" defer></script>
    <script src="../javascript/favRestaurant.js" defer></script>
    <script src="../javascript/favDish.js" defer></script>    
    <title><?=$restaurant->$name?></title>
</head>
<body>
<?php 

    output_header_wo_search($db);

    output_restaurant_owner($restaurant, $db, Restaurant::getRating($db,$_GET['id']), $restaurantImage);

    output_cart();

?>
    <?php if(count($menu)> 0){ ?>
    <section id = "dishes">

        <?php output_dishes($menu,$db)?>
        
    </section>
    <?php } ?>
    <form action="../pages/edit_restaurant.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="editRestaurantDish">
            <button class="button-4" name= "editDish" id = "editDish" role="button">Edit Dishes</button>
    </form>
    
    <section id = "reviews">
    <h3>Comentários:</h3>
        <?php output_comments($comments,$answers,True,$db)?>


        
    </section>
    <?php output_footer()?>

    </body>
</html>

