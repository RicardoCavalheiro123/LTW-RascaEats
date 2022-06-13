
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <script src="cart.js" defer></script>
    <script src="search.js" defer></script>
    <script src="favRestaurant.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
    <?php output_header($db)?>

    <?php 
    if(isset($_POST['addDish'])){ ?>
    <div class = "editInf">
    <form action="restaurant_edit_server.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="logout">
        <img src="<?php echo $imageDish; ?>">
        <div class="row">
            <span class="bold">Name</span>
            <input type="text" class = "input-field" name = "dishName" required>
            
        </div>
        <div class="row">
            <span class="bold">Price</span>
            <span class="b"><p>Example: 3.5</p></span>
            <input type="text" class = "input-field" name = "dishPrice" required>
        </div>
        <div class="row">

            <span class="bold"><p>Category</p></span>


            <select id="cars" name = "dishCategory" class = "input-field">
                <option value="Prato Principal">Prato Principal</option>
                <option value="Bebida">Bebida</option>
                <option value="Sobremesa">Sobremesa</option>
                <option value="Entrada">Entrada</option>
            </select>
            
        </div>

        <div class="row">
            <input type="file" name="file">
        </div>
        
        
            <button class="button-3" name = "addDish2" id = "addDish2" role="button">Save</button>
    </form>
        </div>

    </div>
    <?php }
    ?>




    <?php output_footer()  ?>
    </body>
</html>