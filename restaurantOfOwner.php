
<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');
    require_once('templates/common.php');

    require_once('templates/dishes.php');
    require_once('sql/dish.php');
    require_once('sql/favRestaurant.php');

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
    $images = getImages($db);

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
    <title><?=$restaurant->$name?></title>
</head>
<body>
<?php output_header()?>
    

    <section id= "restaurant">
        <p>
            <?php
            $category = 'category';
            echo $restaurant->$category;
       
            ?>
        </p>
        
        <p>
            <?php 
            $name = 'restaurantName';
            echo $restaurant->$name ;
            ?>
        </p>
        <p>
            <?php 
            $rating = 'rating';
            echo $restaurant->$rating ?><i class="fa-solid fa-star"></i>
        </p>
        <p>
            <?php
            $phoneNumber = 'phoneNumber'; 
            echo $restaurant->phoneNumber ?>
            <i class="fa-solid fa-phone"></i>
        </p>
        <p>
            <?php 
            $address = 'adress';
            echo $restaurant->address; ?>
            
        </p>
        <img class = "slide" src="https://picsum.photos/650/400?food1" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food2" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food3" alt="Restaurant photo">
        <button class="left-button" onclick="plusDivs(-1)">&#10094;</button>
        <button class="right-button" onclick="plusDivs(+1)">&#10095;</button>
   
        <form action="editRestaurant.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="editRestaurant">
                <button class="button-4" name= "editInfo" id = "editInfo" role="button">Edit Information</button>
        </form>

        <?php if(isset($_SESSION['id'])){ ?>
            <span class="favRestaurant">

                    <button type='submit' name='favRestaurantSubmit' <?php 
                        if (checkFavRestaurant($db)) echo "class = exists" 
                        ?> 
                        onclick="toggleFavRestaurant(<?=$_SESSION['id']?>, <?=$_GET['id']?>)">
                        <i class='fa-solid fa-heart'></i>
                    </button> 

            </span>
        <?php } ?> 
                
        
    </section>

    <?php output_cart(); ?>
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
            echo "<form method='POST' action='".setComments($db)."'> "?>
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