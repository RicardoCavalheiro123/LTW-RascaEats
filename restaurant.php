<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');
    require_once('templates/common.php');

    require_once('templates/dishes.php');
    require_once('sql/dishes.php');
    require_once('sql/favRestaurant.php');

    require_once('cart.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = Restaurant::getRestaurant($db);
    $menu = getMenu($db);
    $images = getImages($db);

    $comments = Comments::getComments($db);
    $ratings = Comments::getRatings($db);

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
    <script src="script.js" defer></script>
    <script src="cart.js" defer></script>
    <script src="search.js" defer></script>
    <script src="favRestaurant.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
<?php 

    output_header();

    output_restaurant($restaurant, $db, $ratings);

    output_cart();

?>
    
    <section id = "dishes">

        <?php output_dishes($menu,$images)?>
    
    </section>
    <section id = "reviews">
        <h3>Comentários:</h3>
        <?php output_comments($comments)?>

        <h3>Deixe o seu comentário - </h3>

        <?php if (!isset($_SESSION['id'])){ ?> 
                <p><a href="login_register.php">Efetue login para comentar</a></p>
<?php       } 
        else{
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
<?php } ?>

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