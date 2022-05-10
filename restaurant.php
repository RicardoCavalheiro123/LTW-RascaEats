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
    <script src="script.js" defer></script>
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
            Categoria
        </p>
        <p>
            Nome
        </p>
        <p>
            Rating
        </p>
        <p>
            Contacto
        </p>
        <p>
            Morada
        </p>
        <img class = "slide" src="https://picsum.photos/500/300?food1" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/500/300?food2" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/500/300?food3" alt="Restaurant photo">
        <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
        
    </section>

    <section id = "car">
        carrinho
    </section>
    <section id = "dishes">
        <p>Prato 1 .............. 25€</p>
        <input class="quantity" type="number" value="0">
        <p>Prato 2 .............. 35€</p>
        <input class="quantity" type="number" value="0">
        <p>Prato 3 .............. 15€</p>
        <input class="quantity" type="number" value="0">
    </section>
    <section id = "reviews"> 
            Deixe o seu comentário
            <article>
                <h4>abc disse: </h4>
                <p>Gostei muito</p>
            </article>
            <article>
                <h4>abc disse: </h4>
                <p>Gostei muito</p>
            </article>
            <article>
                <h4>abc disse: </h4>
                <p>Gostei muito</p>
            </article>
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