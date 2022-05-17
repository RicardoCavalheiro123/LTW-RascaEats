<?php 
    declare(strict_types = 1);
    session_start();
    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    require_once('templates/common.php');
    //require_once('templates/comments.php');
    //require_once('sql/comments.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = getCategories($db);

    //$comments = getComments($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Rasca Eats</title>
</head>
<body>
<header>
        <h1><a href="index.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils"></i>
        <form action="https://www.google.pt/?hl=pt-PT" method="get" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ ?>
                    <form action="actionlogout.php" method="get" id="logout2">
                        <a href="profilePage.php"> <?php echo $_SESSION['name'] ?> </a>
                        <a href="actionlogout.php">Logout</a>
                    </form>
                    
                
<?php            }
            else{ ?>
                
                    <div class="login">
                        <a href="login_register.php">Login | Register</a>
                    </div>
<?php       }
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
    

    <section id= "restaurants"><?php 
        foreach($categories as $category){  ?>
            <section id = "category">
                <h2>
                <?php echo $category['category']?>
                </h2> <?php $restaurants = getRestaurantCategory($db, $category['category']);
                foreach($restaurants as $restaurant){ ?>
                    <article>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="https://picsum.photos/300/300?<?php echo $restaurant['restaurantName']?>" alt="Restaurant photo"></a>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                        <p><?php echo $restaurant['rating']?>/5.0</p>
                        <p><?php echo $restaurant['adress']?></p>
                    </article>
        <?php   } ?>
            </section>

<?php   } ?>
        
        
    </section>
    <footer>
        <div class="footer-content">
            <h3>Descubra e reserve dos melhores restaurantes</h3>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022 Rasca Eats</p>
        </div>
    </footer>

    </body>
</html>