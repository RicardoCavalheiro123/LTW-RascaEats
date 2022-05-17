<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');

    require_once('templates/dishes.php');

    session_start();

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $restaurant = getRestaurant($db);
    $menu = getMenu($db);
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
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <script src="cart.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
<header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils"></i>
        <form action="https://www.google.pt/?hl=pt-PT" method="get" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){
                //drawLogoutForm($_SESSION['name']);
                echo'<form action="actionlogout.php" method="get" id="logout2">
                        <a href="profilePage.php">antol</a>
                        <a href="actionlogout.php">Logout</a>
                    </form>';
                    
                
            }
            else{
                
                echo '<div class="login">
                        <a href="login_register.php">Login | Register</a>
                    </div>';
            }
                ?>
            
        </form>
        <form action="file:///C:/Users/antol/LTW_php/Projeto_LTW/proj.html" method="get">
            <div class="search">
                <input type="text" class="searchInput" name="search" placeholder="search...">
                <button type="submit" class="searchButton">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
            
    </header>
    

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
        
    </section>

    <section id="favRestaurant">
        <?php ?>
    </section>

    <section id = "cart">
    <table>
        <thead>
          <tr><th>Produto</th><th>Quantidade</th><th>Price</th><th>Total</th></tr>
        </thead>
        <tr></tr>
        <tfoot>
          <tr><th colspan="3">Total:</th><th>0</th></tr>
        </tfoot>
      </table>
    </section>
    <section id = "dishes">

        <?php output_dishes($menu)?>
    
    </section>
    <section id = "reviews"> 
        <?php output_comments($comments)?>

        <h3>Deixe o seu comentário - </h3>

        <?php echo "<form method='POST' action='".setComments($db)."'> "?>
            <input type='hidden' name='clientId' value='1'>
            <input type='hidden' name='restaurantId' value= <?php echo $_GET['id'] ?> >
            <?php echo "<input type='hidden' name='date' value='".date('Y-m-d')."'> "?>
            <textarea name='comment'></textarea><br>
            <button type='submit' name='commentSubmit'>Comment</button>
        </form>


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