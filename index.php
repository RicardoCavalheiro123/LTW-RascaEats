<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = getCategories($db);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ex</title>
</head>
<body>
    <header> 
        <img src="logo.png" alt="Logo" > <br>
        <input type="button" value="Login/Register"> <br>
        <input type="text" placeholder = "Search Restaurants">
        <input type="button" value="Search">

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