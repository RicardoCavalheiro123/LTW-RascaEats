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
    <link rel="stylesheet" href="restaurant.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Restaurante</title>
</head>
<body>
<header>
        <h1>Rasca Eats</h1>
        <i class="fa-solid fa-utensils"></i>
        <form action="https://www.google.pt/?hl=pt-PT" method="get" id="loginForm">
            <div class="login">
                <input type="button" value="Login | Register">
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
    

    <section id= "restaurant">
        <p>
            Category
        </p>
        <p>
            Nome
        </p>
        <p>
            Rating
        </p>
        <p>
            Morada <br>
            Contacto
        </p>
        <img src="https://picsum.photos/300/300?food1" alt="Restaurant photo">
    </section>
    <section id = "reviews"> 
            Deixe o seu comentário
            <article>
                <h3>abc disse: </h3>
                <h4>Gostei muito</h4>
            </article>
            <article>
                <h3>abc disse: </h3>
                <h4>Gostei muito</h4>
            </article>
            <article>
                <h3>abc disse: </h3>
                <h4>Gostei muito</h4>
            </article>
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