<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');
    require_once('templates/common.php');

    require_once('templates/dishes.php');
    require_once('sql/dishes.php');
    require_once('sql/favRestaurant.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = getRestaurant($db);
    $menu = getMenu($db);
    $images = getImages($db);

    

    $comments = getComments($db);
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
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <script src="cart.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
<?php output_header()?>
    

    <section id= "restaurant">
        <p>
            <?php echo $restaurant['category'] ?>
        </p>
        <p>
            <?php echo $restaurant['restaurantName'] ?>
        </p>
        <p>
            <?php echo $restaurant['rating'] ?><i class="fa-solid fa-star"></i>
        </p>
        <p>
            <?php echo $restaurant['phoneNumber'] ?>
        </p>
        <p>
            <?php echo $restaurant['adress'] ?>
        </p>
        <img class = "slide" src="https://picsum.photos/500/300?food1" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/500/300?food2" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/500/300?food3" alt="Restaurant photo">
        <button class="left-button" onclick="plusDivs(-1)">&#10094;</button>
        <button class="right-button" onclick="plusDivs(+1)">&#10095;</button>

        <?php if(isset($_SESSION['id'])){ ?>
            <span class="favRestaurant">
                <form method='POST' action=<?php

                    if(!checkFavRestaurant($db)) echo setFavRestaurant($db);
                    else echo deleteFavRestaurant($db);

                ?>>

                    <input type='hidden' name='clientId' value='1'>
                    <input type='hidden' name='restaurantId' value= <?php echo $_GET['id'] ?>>
                    <button type='submit' name='favRestaurantSubmit' class = <?php 
                        if (isset($_SESSION['id']) && checkFavRestaurant($db)) echo "exists" 
                ?>
                        ><i class='fa-solid fa-heart'></i></button> 
                </form>

            </span>
        <?php } ?> 
                
        
    </section>

    <section id = "cart">
    <table>
        <thead>
          <tr><th>Produto</th><th>Quantidade</th><th>Price</th><th>Total</th><th>Remove</th></tr>
        </thead>
        <tr></tr>
        <tfoot>
          <tr><th colspan="3">Total:</th><th>0</th><th></th></tr>
        </tfoot>
        </table>
        <input type="button" value="Encomendar" id="place-order" onclick = "placeOrder()">
        <script>
            function placeOrder(){
                <?php 
                    $stmt = $db->prepare('INSERT INTO Request(clientId, state) VALUES ("'.$_SESSION['id'].'", "Preparing")');
                    $stmt->execute();
                    $stmt = $db->prepare('SELECT last_insert_rowid()');
                    $stmt->execute();
                    $requestId = $stmt->fetch();

                ?>;

                const table = document.querySelectorAll("#cart table > tr");
                for(const row of table){
                    var quantity = row.querySelector("td:nth-child(3)").textContent;
                    document.cookie = escape('currentDishQuantity') + "=" + escape(quantity);
                    var id = row.querySelector("td:nth-child(1)").textContent;
                    document.cookie = escape('currentDishId') + "=" + escape(id);
                    <?php 
                        $stmt = $db->prepare('INSERT INTO CurrentRequest VALUES (?,?,?)');
                        $stmt->execute(array($_COOKIE['currentDishId'], $requestId['last_insert_rowid()'], $_COOKIE['currentDishQuantity']));
                    ?>
                    
                    

                }
                const t = document.querySelector("#cart table");
                const rows = document.querySelectorAll("#cart table > tr");
                for(const row of rows){
                    row.remove();
                }
                t.querySelector("tfoot th:nth-child(2)").textContent = 0;
            }
            
        </script>
    
    
    </section>
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