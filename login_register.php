<?php 
session_start();
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Ex</title>
</head>
<body>
<header>
        <h1><a href = "frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils"></i>
        <div class="login" id = "loginForm">
            <a href="login_register.php">Login | Register</a>
        </div>
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
            <form id="login" action= "server.php" method="POST" class = "input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" name = "username" placeholder="Username" required>
                <i class="fa-solid fa-lock"></i>
                <input type="password" class = "input-field" name = "password" placeholder="Password" required>
                <button type="submit" name = "submit_login" class = "submit-btn">Log in</button>
                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<div class= error> $error </div>";
                    }
                ?>  
            </form>
            <form id="register" action = "server.php" method = "POST" class = "input-group">
                <i class="fa-solid fa-signature"></i>
                <input type="text" class = "input-field" name = "name" placeholder= " Full Name" required>
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" name = "username" placeholder="Username" required>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class = "input-field" name = "email" placeholder="Email" required>
                <i class="fa-solid fa-lock"></i>
                <input type="password" class = "input-field" name = "password" placeholder="Password" required>
                <i class="fa-solid fa-map-location-dot"></i>
                <input type="text" class = "input-field" name = "adress" placeholder="Adress" required>
                <i class="fa-solid fa-phone"></i>
                <input type="tel" class = "input-field" name = "phone_number" placeholder="Phone Number" required>
                <button type="submit" name = "submit_register" class = "submit-btn">Register</button>
                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<div class= error> $error </div>";
                    }
                ?> 
            </form>
        </div>
        
    </div>
   
    </script>

    <script>
        var x = document.getElementById("login")
        var y = document.getElementById("register")
        var z = document.getElementById("btn")
        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
    }
    </script>
    </body>
    <footer>
        <div class="footer-content">
            <h3>Descubra e reserve dos melhores restaurantes</h3>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022 Rasca Eats</p>
        </div>
    </footer>
</html>
<?php
    unset($_SESSION["error"]);
?>