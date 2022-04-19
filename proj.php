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
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class = "input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" placeholder="Username" required>
                <i class="fa-solid fa-lock"></i>
                <input type="text" class = "input-field" placeholder="Password" required>
                <button type="submit" class = "submit-btn">Log in</button>
            </form>
            <form id="register" class = "input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" placeholder="Username" required>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class = "input-field" placeholder="Email" required>
                <i class="fa-solid fa-lock"></i>
                <input type="text" class = "input-field" placeholder="Password" required>
                <i class="fa-solid fa-map-location-dot"></i>
                <input type="text" class = "input-field" placeholder="Adress" required>
                <i class="fa-solid fa-phone"></i>
                <input type="text" class = "input-field" placeholder="Phone Number" required>
                <button type="submit" class = "submit-btn">Register</button>
            </form>
        </div>
        
    </div>
    <footer>
        <div class="footer-content">
            <h3>Descubra e reserve dos melhores restaurantes</h3>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022 Rasca Eats</p>
        </div>
    </footer>
    </script>

    <section id= "restaurants">
        
    </section>

    </body>
</html>