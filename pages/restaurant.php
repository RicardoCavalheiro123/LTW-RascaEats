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
        if($isOwner){
            header("Location: ../pages/owner_restaurant.php?id=$restaurant->restaurantId");
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
    <link rel="stylesheet" href="../css/edit.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="../javascript/cart.js" defer></script>
    <script src="../javascript/favRestaurant.js" defer></script>
    <script src="../javascript/favDish.js" defer></script>    
    <title><?=$restaurant->$name?></title>
</head>
    <body>
<?php 

    output_header_wo_search($db);

    output_restaurant($restaurant, $db, Restaurant::getRating($db,$_GET['id']), $restaurantImage);

    output_cart();

?>
    <?php if(count($menu) > 0) { ?>
    <section id = "dishes">

        <?php output_dishes($menu,$db,$restaurantImage)?>
    
    </section>
<?php } ?>
    <section id = "reviews">
        <h3>Comentários:</h3>
        <?php output_comments($comments,$answers,False,$db)?>

        <h3>Deixe o seu comentário - </h3>

        <?php if (!isset($_SESSION['id'])){ ?> 
                <p><a href="../pages/login_register.php">Efetue login para comentar</a></p>
<?php       } 
        else{

            if(Restaurant::checkOrder($db,$_GET['id'],$_SESSION['id'])){
                echo "<form method='POST' action='".Comments::setComments($db)."'> "?>
                <input type='hidden' name='clientId' value= <?php echo $_SESSION['id']?> >
                <input type='hidden' name='restaurantId' value= <?php echo $_GET['id'] ?> >
                <?php echo "<input type='hidden' name='date' value='".date('Y-m-d')."'> "?>
                <textarea name='comment'></textarea><br>
                <div class ="rating">
                    <input type="radio" id="fiveStars" name="rating" value="5" />
                    <label for="fiveStars" title="five stars">☆</label>
                    <input type="radio" id="fourStars" name="rating" value="4" />
                    <label for="fourStars" title="four stars">☆</label>
                    <input type="radio" id="threeStars" name="rating" value="3" />
                    <label for="threeStars" title="three stars">☆</label>
                    <input type="radio" id="twoStars" name="rating" value="2" />
                    <label for="twoStars" title="two stars">☆</label>
                    <input type="radio" id="oneStar" name="rating" value="1" />
                    <label for="oneStar" title="one star">☆</label>      
                </div>      
                <button type='submit' name='commentSubmit'>Comment</button>

                </form>
            <?php } 
            
            else { ?>

                <p>Tem que fazer uma encomenda primeiro!</p>
                
            <?php } ?>


<?php  } ?>

    </section>
    <footer>
        <div class="footer-content">
            <h4>Descubra e reserve dos melhores restaurantes</h4>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022 Rasca Eats</p>
        </div>
    </footer>

    </body>
</html>