<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = Restaurant::getCategories($db);

    $comments = getComments($db);
    header('Location: frontpage.php');
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
            <div class="login">
                <a href="proj.php">Login | Register</a>
            </div>
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
    

    <section id= "restaurants">
        <section id = "category">
            <h2>
            Fast-Food
            </h2>
            
            <article>
                <a href="restaurant.php?id=1"><img src="https://picsum.photos/300/300?food1" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=1"><p>Restaurante 1</p></a>
                <p>9.3/10</p>
                <p>Gaia</p>
            </article>
            <article>
                <a href="restaurant.php?id=2"><img src="https://picsum.photos/300/300?food2" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=2"><p>Restaurante 2</p></a>
                <p>8.1/10</p>
                <p>Maia</p>
            </article>
            <article>
                <a href="restaurant.php?id=3"><img src="https://picsum.photos/300/300?food3" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=3"><p>Restaurante 3</p></a>
                <p>9.5/10</p>
                <p>Gaia</p> 
            </article>
            
        </section>
        <section id = "category">
            <h2>
            Italiano
            </h2>
            <article>
                <a href="restaurant.php?id=4"><img src="https://picsum.photos/300/300?food4" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=4"><p>Restaurante 4</p></a>
                <p>9.3/10</p>
                <p>Gaia</p>
            </article>
            <article>
                <a href="restaurant.php?id=5"><img src="https://picsum.photos/300/300?food5" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=5"><p>Restaurante 5</p></a>
                <p>8.1/10</p>
                <p>Maia</p>
            </article>
            <article>
                <a href="restaurant.php?id=6"><img src="https://picsum.photos/300/300?food6" alt="Restaurant photo"></a>
                <a href="restaurant.php?id=6"><p>Restaurante 6</p></a>
                <p>9.5/10</p>
                <p>Gaia</p> 
            </article>
            
        </section>
        
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