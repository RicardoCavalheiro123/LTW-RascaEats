<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    require_once('templates/comments.php');
    require_once('sql/comments.php');


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = getCategories($db);
    $restaurant = getRestaurant($db);

    $comments = getComments($db);
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
    <script src="cart.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
<header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
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
        <button class="left-button" onclick="plusDivs(-1)">&#10094;</button>
        <button class="right-button" onclick="plusDivs(+1)">&#10095;</button>
        
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
        <article>
            <p class="dishName">Prato 1</p>
            <p class = "dishPrice">25</p>
            <input class="quantity" type="number" value="0">
            <button class="buy">Adicionar ao carrinho</button>
        </article>
        <article>
            <p class="dishName">Prato 2</p>
            <p class = "dishPrice">35</p>
            <input class="quantity" type="number" value="0">
            <button class="buy">Adicionar ao carrinho</button>
        </article>
        <article>
            <p class="dishName">Prato 3</p>
            <p class = "dishPrice">15</p>
            <input class="quantity" type="number" value="0">
            <button class="buy">Adicionar ao carrinho</button>
        </article>
        
    </section>
    <section id = "reviews"> 
            Deixe o seu comentário

            <?php output_comments($comments) ?>
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